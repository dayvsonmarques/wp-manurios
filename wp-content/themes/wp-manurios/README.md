# WP Manurios Theme

Um tema WordPress personalizado construído com Bootstrap 5.3.3.

## Características

- **Bootstrap 5.3.3**: Framework CSS moderno e responsivo
- **Design Responsivo**: Otimizado para todos os dispositivos
- **Templates Completos**: Página inicial, posts, páginas, arquivos, busca e 404
- **Sistema de Widgets**: Sidebar e rodapé com suporte a widgets
- **Navegação**: Menu principal e rodapé
- **Comentários**: Sistema de comentários estilizado com Bootstrap
- **Busca**: Formulário de busca integrado
- **SEO Friendly**: Estrutura semântica otimizada

## Estrutura de Arquivos

```
wp-manurios/
├── css/                    # Arquivos CSS do Bootstrap
├── js/                     # Arquivos JavaScript
│   ├── bootstrap.bundle.min.js
│   └── theme.js           # JavaScript personalizado do tema
├── style.css              # Estilos do tema
├── functions.php          # Funções do tema
├── index.php              # Template principal
├── header.php             # Cabeçalho
├── footer.php             # Rodapé
├── single.php             # Template de post único
├── page.php               # Template de página
├── archive.php            # Template de arquivo
├── search.php             # Template de busca
├── 404.php                # Template de erro 404
├── comments.php           # Template de comentários
├── searchform.php         # Formulário de busca
└── README.md              # Este arquivo
```

## Instalação

1. Faça upload da pasta `wp-manurios` para `/wp-content/themes/`
2. Ative o tema no painel administrativo: **Aparência > Temas**
3. Configure os menus em **Aparência > Menus**
4. Adicione widgets em **Aparência > Widgets**

## Personalização

### Cores e Estilos
Edite o arquivo `style.css` para personalizar as cores e estilos do tema.

### JavaScript
O arquivo `js/theme.js` contém funcionalidades personalizadas como:
- Scroll suave para âncoras
- Botão "voltar ao topo"
- Estados de carregamento em formulários
- Inicialização de componentes Bootstrap

### Widgets Disponíveis
- **Sidebar Principal**: Widgets para a barra lateral
- **Rodapé 1, 2, 3**: Três colunas de widgets no rodapé

## Suporte

Este tema foi desenvolvido para ser compatível com:
- WordPress 6.0+
- PHP 7.4+
- Bootstrap 5.3.3

## Licença

Este tema é distribuído sob a licença GPL v2 ou posterior.
