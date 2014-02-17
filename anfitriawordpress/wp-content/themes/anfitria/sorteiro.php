<?php
/* Template Name: sorteio */

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

get_header();
?>
<style>
.menu{display:none;}
</style>

<section id="sorteio">
    
    <div id="sorteio-page">
        <div id="header">
            Sorteio
        </div>
        
        <div id="content">            
              <p>Preencha o formulário abaixo para participar do sorteio</p>
              <br><br>
              <table>                 
                      <tbody>
                          <tr>

      <td class="style5" style="padding-left:15px; padding-right:15px;">
      
      <form method="post" name="form1"> 

<table width="97%" border="0" cellspacing="5" cellpadding="5"> 

<tbody>
    
    <tr>

  <td width="103" align="right" class="style5">Nome:</td>

  <td width="486" align="left"><input name="nome" type="text" size="40" maxlength="40" id="nome">

 

</tr> 

<tr>

  <td align="right" nowrap="nowrap" class="style5">E-mail: </td>

  <td align="left"><input name="email" type="text" size="40" maxlength="60" id="email"></td> 

</tr> 

<tr>

  <td align="right" valign="middle" nowrap="nowrap" class="style5">Endereço de Envio:</td>

  <td align="left" valign="middle"><textarea name="mensagem" cols="30" rows="4" id="edereco"></textarea></td> 

  </tr> 

<tr>

  <td align="right" nowrap="nowrap">&nbsp;</td>

  <td><input type="submit" name="Submit" id="contato-submit-sorteio" value="Cadastrar"></td> 

</tr> 

</tbody></table> 

</form>
      
      </td>

      </tr>
                      </tbody>
              </table>
            
        </div>
        
        <div id="footer">
            
        </div>
    </div>
    
</section> <?php get_footer();?>