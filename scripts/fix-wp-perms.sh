#!/usr/bin/env bash
# fix-wp-perms.sh — Ajusta ownership e permissões para uma instalação WordPress
# Uso seguro: rode com sudo se necessário
#   sudo ./scripts/fix-wp-perms.sh -y --acl
# Opções:
#   -p, --path <dir>        Caminho da instalação (default: /var/www/html/manurios)
#   -u, --user <user>       Dono (usuário) (default: SUDO_USER ou usuário atual)
#   -g, --group <group>     Grupo (default: www-data)
#       --acl               Define ACLs padrão para user e group terem rwx
#       --clear-immutable   Remove atributo imutável (i) em wp-content (cautela)
#   -y, --yes               Sem confirmação interativa
#       --dry-run           Apenas mostra o que faria
#   -h, --help              Ajuda

set -euo pipefail

DEFAULT_PATH="/var/www/html/manurios"
DEFAULT_USER="${SUDO_USER:-$(id -un)}"
DEFAULT_GROUP="www-data"

DO_ACL=false
CLEAR_IMMUTABLE=false
YES=false
DRY_RUN=false

WP_PATH=""
WP_USER=""
WP_GROUP=""

usage() {
  cat <<EOF
Uso: $(basename "$0") [opções]

Opções:
  -p, --path <dir>        Caminho da instalação (default: ${DEFAULT_PATH})
  -u, --user <user>       Dono (usuário) (default: ${DEFAULT_USER})
  -g, --group <group>     Grupo (default: ${DEFAULT_GROUP})
      --acl               Define ACLs padrão (user e group com rwx)
      --clear-immutable   Remove atributo imutável (i) em wp-content
  -y, --yes               Não perguntar confirmação
      --dry-run           Não executa, só imprime comandos
  -h, --help              Mostra esta ajuda
EOF
}

# Parse args
while [[ $# -gt 0 ]]; do
  case "$1" in
    -p|--path) WP_PATH="${2:-}"; shift 2;;
    -u|--user) WP_USER="${2:-}"; shift 2;;
    -g|--group) WP_GROUP="${2:-}"; shift 2;;
    --acl) DO_ACL=true; shift;;
    --clear-immutable) CLEAR_IMMUTABLE=true; shift;;
    -y|--yes) YES=true; shift;;
    --dry-run) DRY_RUN=true; shift;;
    -h|--help) usage; exit 0;;
    *) echo "[erro] Opção desconhecida: $1" >&2; usage; exit 2;;
  esac
done

WP_PATH="${WP_PATH:-$DEFAULT_PATH}"
WP_USER="${WP_USER:-$DEFAULT_USER}"
WP_GROUP="${WP_GROUP:-$DEFAULT_GROUP}"

# Checks básicos
if [[ ! -d "$WP_PATH" ]]; then
  echo "[erro] Caminho não existe: $WP_PATH" >&2
  exit 1
fi

needbin() { command -v "$1" >/dev/null 2>&1 || { echo "[erro] Binário requerido não encontrado: $1" >&2; exit 1; }; }
needbin chown
needbin chmod
needbin find
needbin xargs
if $DO_ACL; then needbin setfacl; fi
if $CLEAR_IMMUTABLE; then needbin lsattr; needbin chattr; fi

run() {
  if $DRY_RUN; then
    printf '[dry-run] %s\n' "$*"
  else
    eval "$@"
  fi
}

cat <<PLAN
Plano de execução:
- Ownership:       ${WP_USER}:${WP_GROUP} em ${WP_PATH}
- Diretórios:      755 (geral) | 775 em wp-content{,/themes,/plugins,/uploads,/upgrade}
- Arquivos:        644 (geral) | 664 em wp-content{,/themes,/plugins,/uploads,/upgrade}
- wp-config.php:   640 (se existir)
- Git lock:        remover .git/index.lock (se existir)
- ACLs:            $( $DO_ACL && echo 'ATIVADAS' || echo 'desativadas' )
- Clear immutable: $( $CLEAR_IMMUTABLE && echo 'ATIVADO (apenas wp-content)' || echo 'desativado' )
- Dry-run:         $( $DRY_RUN && echo 'SIM' || echo 'não' )
PLAN

if ! $YES; then
  read -r -p "Prosseguir? [y/N] " resp
  case "${resp:-N}" in
    y|Y) ;;
    *) echo "Abortado."; exit 0;;
  esac
fi

# 1) Ownership total (requer sudo se não for dono atual)
run chown -R "$WP_USER:$WP_GROUP" "$WP_PATH"

# 2) Permissões gerais
run "find '$WP_PATH' -type d -print0 | xargs -0 chmod 755"
run "find '$WP_PATH' -type f -print0 | xargs -0 chmod 644"

# 3) Pastas de escrita (wp-content e subpastas principais)
for sub in wp-content wp-content/themes wp-content/plugins wp-content/uploads wp-content/upgrade; do
  dir="$WP_PATH/$sub"
  if [[ -d "$dir" ]]; then
    run chmod 775 "$dir"
    run "find '$dir' -type d -print0 | xargs -0 chmod 775"
    run "find '$dir' -type f -print0 | xargs -0 chmod 664"
  fi
done

# 4) Endurecer wp-config.php
if [[ -f "$WP_PATH/wp-config.php" ]]; then
  run chmod 640 "$WP_PATH/wp-config.php"
fi

# 5) Limpar lock do Git se existir
if [[ -f "$WP_PATH/.git/index.lock" ]]; then
  run rm -f "$WP_PATH/.git/index.lock"
fi

# 6) ACL (opcional)
if $DO_ACL; then
  run "setfacl -R -m u:$WP_USER:rwx,g:$WP_GROUP:rwx '$WP_PATH'"
  run "setfacl -dR -m u:$WP_USER:rwx,g:$WP_GROUP:rwx '$WP_PATH'"
fi

# 7) Remover imutáveis (opcional) — limitado a wp-content
if $CLEAR_IMMUTABLE; then
  WPC="$WP_PATH/wp-content"
  if [[ -d "$WPC" ]]; then
    # Lista itens com atributo i e remove somente nesses
    while IFS= read -r target; do
      [[ -n "$target" ]] || continue
      run chattr -i "$target"
    done < <(lsattr -R "$WPC" 2>/dev/null | awk '/ i [^ ]*$/ {print $NF}')
  fi
fi

echo "Concluído com sucesso."
