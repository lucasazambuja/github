<?php

function get_formulario_comments(){?>

                    <div id="comentario-enviar">
<table width="100%" border="0" cellspacing="15" cellpadding="4" bgcolor="#FEFBF1">
    <tbody>
        <tr>
            <td width="85%"><strong><span class="style4">Deixe um comentário</span></strong>   <?php the_title();?>     <p>O seu endereço de email não será publicado.</p></td>
        </tr>
        
        <tr>
            <td>
                <input name="NOME" type="text" class="style4" id="NOME-<?php the_ID();?>" title="Escreva seu Nome Completo" onfocus="if(this.value=='NOME') this.value='';" onblur="if(this.value=='') this.value='NOME';" value="NOME" size="15">
                <input name="EMAIL" type="text" class="style4" id="EMAIL-<?php the_ID();?>" title="Escreva seu E-mail" onfocus="if(this.value=='E-MAIL') this.value='';" onblur="if(this.value=='') this.value='E-MAIL';" value="E-MAIL" size="23">
            </td>
        </tr>
        
        <tr>
            <td><textarea name="COMENTE" id="COMENTE-<?php the_ID();?>" cols="45" rows="5" class="style5" style="width:100%" title="Seu Comentário" onfocus="if(this.value=='COMENTE') this.value='';" onblur="if(this.value=='') this.value='COMENTE';" value="COMENTE">COMENTE</textarea></td>
        </tr>
        
        <tr>
        <td align="center"><input name="POSTID" type="hidden" class="style4" id="POSTID" title="Digite o Código Aqui" value="<?php the_ID();?>">      <input type="submit" class="button-enviar-comentario" name="button-enviar-comentario" id="button-enviar-comentario" value="Enviar Comentário" style="padding:15px; background-color:#F5F5F5; border:solid 1px #666; color:#000;"></td>
        </tr>

    </tbody>
</table>
</div>
<?php }

// if (isset($_POST['action']) && $_POST['action'] == 'function_comments'){function_comments();}

function function_comments(){
    
    $data = array(
    'comment_post_ID' => $_POST['POSTID'],
    'comment_author' => $_POST['NOME'],
    'comment_author_email' => $_POST['EMAIL'],
    'comment_author_url' => 'http://',
    'comment_content' => $_POST['COMENTE'] . ' - ' . $_POST['NOME'],
    'comment_type' => '',
    'comment_parent' => 0,
    'user_id' => 1,
    'comment_author_IP' => '',
    'comment_agent' => '',
    'comment_approved' => 0
);

wp_insert_comment($data);    
}

add_action('wp_ajax_nopriv_function_comments', 'function_comments');
add_action('wp_ajax_function_comments', 'function_comments');

function cont_comment($postid){
    global $wpdb;
    $comment = $wpdb->get_var('SELECT count(comment_ID) FROM '.$wpdb->prefix.'comments where comment_post_ID = '.$postid.' and comment_approved = 1 and comment_parent = 0');
    return $comment;
}
?>