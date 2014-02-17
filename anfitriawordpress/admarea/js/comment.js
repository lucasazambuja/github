/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function comment_admarea(){
    
    $('.responder').click(function(){
        id = $(this).parent().parent().parent().attr('id').replace('comentario-','');
            $.ajax({
                    type: 'POST',
                    url: '../wp-admin/admin-ajax.php',
                     data: {
                         action : 'comments_responder',
                         comentario : $(this).prev().val(),
                         commentid : id,
                         postid : $(this).parent().attr('id').replace('textarea-post-', '')
                    },
                     
                    success:function(results, textStatus, XMLHttpRequest){
                        alert('comentario respondido com sucesso!');
                        view_comments();
                    }
             });
        });
        
        $('.deletar img').click(function(){
            commentid = $(this).parent().parent().parent().attr('id').replace('comentario-','');
            $(this).parent().parent().parent().empty();
            $.ajax({
                    type: 'POST',
                    url: '../wp-admin/admin-ajax.php',
                     data: {
                         action : 'comments_delete',
                         commentid : commentid
                    },
                     
                    success:function(results, textStatus, XMLHttpRequest){
                        
                    }
             });
        });
        
        $('.atualizar-resposta').click(function(){
            commentid = $(this).parent().parent().parent().attr('id').replace('comentario-','');
            $.ajax({
                    type: 'POST',
                    url: '../wp-admin/admin-ajax.php',
                     data: {
                         action : 'update_comment_admarea',
                         content : $(this).prev().val(),
                         commentid : commentid
                    },
                     
                    success:function(results, textStatus, XMLHttpRequest){
                        alert('comentario atualizado com sucesso!');
                    }
             });
        });
        
        $('.ativar img').click(function(){
        id = $(this).parent().parent().parent().attr('id').replace('comentario-','')
        $(this).attr('src','../wp-content/themes/anfitria/admin/admarea/encaminhar.gif');
            $.ajax({
                    type: 'POST',
                    url: '../wp-admin/admin-ajax.php',
                     data: {
                         action : 'aproved_comment_admarea',
                         commentid : id
                    },
                     
                    success:function(results, textStatus, XMLHttpRequest){
                        alert('comentario aprovado');
                    }
             });
        });
        
}
