# WordPress Manurios

Projeto WordPress com tema customizado "wp-manurios" desenvolvido com Bootstrap 5.3.3 e sistema completo de gerenciamento de banners.

## 🚀 Características

- **WordPress 6.4.2** - Versão mais recente
- **Tema Customizado** - wp-manurios com Bootstrap 5.3.3
- **Tradução PT-BR** - Interface completamente em português
- **Sistema de Banners** - Gerenciamento completo de banners com suporte a mídia
- **Responsivo** - Design mobile-first
- **SEO Friendly** - Estrutura otimizada

## 📁 Estrutura do Projeto

```
manurios/
├── wp-content/themes/wp-manurios/    # Tema customizado
│   ├── inc/                          # Arquivos de funcionalidades
│   │   ├── banners.php              # Sistema de banners
│   │   ├── banner-display.php       # Exibição de banners
│   │   ├── banner-widget.php        # Widget de banners
│   │   └── banner-admin.php         # Interface administrativa
│   ├── languages/                    # Traduções do tema
│   ├── doc/                         # Documentação
│   │   ├── INSTALACAO.md           # Guia de instalação
│   │   ├── SISTEMA-BANNERS.md      # Documentação do sistema de banners
│   │   └── TRADUCAO-PT-BR.md       # Guia de tradução
│   ├── css/                         # Bootstrap CSS
│   ├── js/                          # Bootstrap JS + tema JS
│   └── *.php                        # Templates do tema
├── wp-content/languages/             # Traduções do WordPress
├── tests/                           # Scripts de teste
└── .gitignore                       # Arquivos ignorados pelo Git
```

## 🛠️ Instalação

### Pré-requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)

### Passos
1. Clone o repositório
2. Configure o banco de dados MySQL
3. Acesse `http://localhost/manurios`
4. Siga o assistente de instalação do WordPress
5. Ative o tema "WP Manurios"

Para instruções detalhadas, consulte: [Guia de Instalação](wp-content/themes/wp-manurios/doc/INSTALACAO.md)

## 🎨 Tema WP Manurios

### Características
- **Bootstrap 5.3.3** integrado
- **Design responsivo** mobile-first
- **Sistema de widgets** completo
- **Navegação** com menu principal e rodapé
- **Comentários** estilizados
- **Busca** integrada
- **SEO** otimizado

### Templates Incluídos
- `index.php` - Página principal
- `single.php` - Posts únicos
- `page.php` - Páginas
- `archive.php` - Arquivos
- `search.php` - Resultados de busca
- `404.php` - Página de erro
- `comments.php` - Sistema de comentários

## 🎬 Sistema de Banners

Sistema completo para gerenciamento de banners com suporte a múltiplos tipos de mídia.

### Tipos de Mídia Suportados
- **Imagens**: JPG, PNG, GIF, WebP, SVG
- **Vídeos**: MP4, WebM, OGG
- **Áudios**: MP3, WAV, OGG
- **URLs Externas**: Qualquer URL válida
- **Fallback**: Imagem destacada

### Funcionalidades
- Interface administrativa dedicada
- Seletor de mídia nativo do WordPress
- Sistema de prioridades
- Controle de período de exibição
- Posicionamento flexível
- Widget para sidebar
- Shortcode para posts/páginas

Para documentação completa: [Sistema de Banners](wp-content/themes/wp-manurios/doc/SISTEMA-BANNERS.md)

## 🌐 Tradução PT-BR

WordPress completamente traduzido para português brasileiro:
- Interface administrativa
- Tema customizado
- Mensagens do sistema
- Formulários e widgets

Para detalhes: [Guia de Tradução](wp-content/themes/wp-manurios/doc/TRADUCAO-PT-BR.md)

## 🧪 Testes

Scripts de teste disponíveis em `/tests/`:
- `teste-traducao.php` - Verificar tradução PT-BR
- `teste-banners.php` - Testar sistema de banners
- `teste-banners-midia.php` - Testar suporte a mídia

## 📚 Documentação

Toda a documentação está organizada em `wp-content/themes/wp-manurios/doc/`:
- **INSTALACAO.md** - Guia completo de instalação
- **SISTEMA-BANNERS.md** - Documentação do sistema de banners
- **TRADUCAO-PT-BR.md** - Guia de tradução

## 🔧 Desenvolvimento

### Estrutura do Tema
```
wp-manurios/
├── style.css              # Estilos principais
├── functions.php          # Funções do tema
├── index.php              # Template principal
├── header.php             # Cabeçalho
├── footer.php             # Rodapé
├── inc/                   # Funcionalidades
├── languages/             # Traduções
├── css/                   # Bootstrap CSS
├── js/                    # JavaScript
└── doc/                   # Documentação
```

### Hooks Disponíveis
```php
// Antes do cabeçalho
do_action('wp_manurios_before_header');

// Antes do conteúdo
do_action('wp_manurios_before_content');

// Topo do rodapé
do_action('wp_manurios_footer_top');
```

### Filtros
```php
// Modificar query de banners
add_filter('wp_manurios_banner_query_args', 'custom_banner_query');

// Modificar HTML do banner
add_filter('wp_manurios_banner_html', 'custom_banner_html');
```

## 📄 Licença

Este projeto está sob licença GPL v2 ou posterior.

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

## 📞 Suporte

Para dúvidas ou problemas:
1. Consulte a documentação em `/doc/`
2. Execute os scripts de teste
3. Verifique os logs de erro
4. Abra uma issue no repositório

---

**Desenvolvido com ❤️ para WordPress**