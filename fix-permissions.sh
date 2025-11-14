#!/bin/bash
# Script para corrigir permissões do WordPress
# Execute com: sudo bash fix-permissions.sh

echo "Ajustando permissões do WordPress..."

# Diretório base
WP_DIR="/var/www/html/manurios"
WP_CONTENT="${WP_DIR}/wp-content"

# Definir dono e grupo (ajuste conforme necessário)
OWNER="m4rqu3s"
GROUP="www-data"

# Ajustar dono do wp-content e subdiretórios
echo "Ajustando dono de wp-content..."
chown -R ${OWNER}:${GROUP} ${WP_CONTENT}

# Ajustar permissões de diretórios (775 = rwxrwxr-x)
echo "Ajustando permissões de diretórios..."
find ${WP_CONTENT} -type d -exec chmod 775 {} \;

# Ajustar permissões de arquivos (664 = rw-rw-r--)
echo "Ajustando permissões de arquivos..."
find ${WP_CONTENT} -type f -exec chmod 664 {} \;

# Garantir que wp-content/themes tenha permissões corretas
echo "Garantindo permissões de wp-content/themes..."
chmod 775 ${WP_CONTENT}/themes
chown ${OWNER}:${GROUP} ${WP_CONTENT}/themes

# Se usar ACLs (setfacl), adicionar permissões específicas
if command -v setfacl &> /dev/null; then
    echo "Configurando ACLs..."
    # Permitir que www-data e m4rqu3s tenham acesso completo
    setfacl -R -m u:www-data:rwx ${WP_CONTENT}
    setfacl -R -m u:${OWNER}:rwx ${WP_CONTENT}
    setfacl -R -m g:${GROUP}:rwx ${WP_CONTENT}
    setfacl -R -d -m u:www-data:rwx ${WP_CONTENT}
    setfacl -R -d -m u:${OWNER}:rwx ${WP_CONTENT}
    setfacl -R -d -m g:${GROUP}:rwx ${WP_CONTENT}
fi

echo "Permissões ajustadas!"
echo ""
echo "Verificando permissões:"
ls -ld ${WP_CONTENT}
ls -ld ${WP_CONTENT}/themes

