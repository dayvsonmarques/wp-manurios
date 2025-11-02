<!DOCTYPE html>
<html>
<head>
    <title>Teste Footer Jadoo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .test-result { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
    </style>
</head>
<body>
    <h1>Teste das Modificações do Footer Jadoo - Versão 2</h1>
    
    <?php
    // Include WordPress
    require_once '/var/www/html/manurios/wp-config.php';
    require_once '/var/www/html/manurios/wp-load.php';
    
    // Include the integration file
    require_once '/var/www/html/manurios/wp-content/themes/wp-manurios/inc/jadoo-integration.php';
    
    echo '<div class="test-result">';
    
    // Test 1: Check if Jadoo file exists
    $jadoo_file = '/var/www/html/manurios/wp-content/themes/wp-manurios/jadoo/public/index.html';
    if (file_exists($jadoo_file)) {
        echo '<div class="success">✅ Arquivo Jadoo encontrado: ' . $jadoo_file . '</div>';
        
        // Test 2: Read the file and test our function
        $content = file_get_contents($jadoo_file);
        $main_match = preg_match('/<main[\s\S]*?<\/main>/', $content, $matches);
        
        if ($main_match) {
            echo '<div class="success">✅ Conteúdo main extraído com sucesso</div>';
            
            // Test 3: Check original footer structure
            if (strpos($matches[0], 'Company') !== false) {
                echo '<div class="success">✅ Coluna "Company" encontrada no original</div>';
            }
            if (strpos($matches[0], 'Contact') !== false) {
                echo '<div class="success">✅ Coluna "Contact" encontrada no original</div>';
            }
            if (strpos($matches[0], 'More') !== false) {
                echo '<div class="success">✅ Coluna "More" encontrada no original</div>';
            }
            
            // Test 4: Apply our footer integration
            $modified = integrate_jadoo_dynamic_footer($matches[0]);
            
            if ($modified !== $matches[0]) {
                echo '<div class="success">✅ Footer foi modificado pela função de integração</div>';
                
                // Check if columns were removed
                if (strpos($modified, 'Company') === false) {
                    echo '<div class="success">✅ Coluna "Company" foi removida</div>';
                } else {
                    echo '<div class="error">❌ Coluna "Company" ainda presente</div>';
                }
                
                if (strpos($modified, 'Contact') === false) {
                    echo '<div class="success">✅ Coluna "Contact" foi removida</div>';
                } else {
                    echo '<div class="error">❌ Coluna "Contact" ainda presente</div>';
                }
                
                if (strpos($modified, 'More') === false) {
                    echo '<div class="success">✅ Coluna "More" foi removida</div>';
                } else {
                    echo '<div class="error">❌ Coluna "More" ainda presente</div>';
                }
                
                // Check if Manu Rios is present
                if (strpos($modified, 'Manu Rios') !== false) {
                    echo '<div class="success">✅ "Manu Rios" encontrado no footer modificado</div>';
                } else {
                    echo '<div class="error">❌ "Manu Rios" não encontrado</div>';
                }
                
            } else {
                echo '<div class="error">❌ Footer não foi modificado - função de integração falhou</div>';
            }
            
        } else {
            echo '<div class="error">❌ Falha ao extrair conteúdo main</div>';
        }
        
    } else {
        echo '<div class="error">❌ Arquivo Jadoo não encontrado: ' . $jadoo_file . '</div>';
    }
    
    echo '</div>';
    ?>
    
    <h2>Instruções:</h2>
    <ol>
        <li>Se todos os testes passaram, as modificações devem estar funcionando</li>
        <li>Acesse uma página que usa o template "Jadoo Landing"</li>
        <li>Force refresh (Ctrl+F5) para limpar o cache</li>
        <li>Verifique se o footer mostra "Manu Rios @ 2025" em vez de "All rights reserved@jadoo.co"</li>
    </ol>
</body>
</html>