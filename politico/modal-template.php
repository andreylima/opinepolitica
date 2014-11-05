<!--   Janela Modal para login ou redirecionamento de registro. -->
<div id="dialog" class="window">
    <a href="#" class="close">Fechar [X]</a>
  
    <div class="title-modal">Para opinar é necessário estar cadastrado.</div>
    <div class="inner_container">
      <div class="login_container">
            
              <form id="formLogin" class="form-vertical well"  action="" method="POST" novalidate="novalidate">
              <div class="face-login-header">
                
                  <?php do_action( 'wordpress_social_login' ); ?>
                <span class="login-social-header">Cadastrar com Facebook</span>
              </div>
              <div class="control-group">
                
                <div class="controls">
                  <input type="text" class="input-large" id="email_log" name="email_log" placeholder="e-mail">
                </div>
               </div>
              <div class="control-group">
                <div class="controls">
                  <input type="password" class="input-large"  id="senha_log" name="senha_log" placeholder="senha">
                </div>
              </div>

              <div class="control-group">
                <button type="submit" class="btn-entrar">Entrar</button>
                <a href="" onclick="" class="lnk-recovery-password" data-toggle="modal">Esqueci
                  minha senha</a>
              </div>
              <div class="show-error-modal"> </div>
            </form>
          
          </div>

    <div class="register-container">
     
    
    <div class="form-vertical well">
         <div class="legend-registerfrm">Não possui cadastro?</div> 
           <div class="face-login-header">
              <?php do_action( 'wordpress_social_login' ); ?>
              
                <span class="login-social-header">Cadastrar com Facebook</span>
              
            </div>
            <?php if (is_home()){ ?>
         <div id="register-manual">Registrar Manualmente</div>     
            <?php } else {?>
          <div id="register-manual-inside">Registrar Manualmente</div>
            <?php } ?>


    </div>
      

    </div>
    </div>
    </div>

    <div id="mask"></div>