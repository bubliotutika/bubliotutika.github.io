<h5>Nous contactez</h5>
<form  action="./contact.php" method="post">
          <?php if (isset($_SESSION['id']) && isset($_SESSION['email']))
                {
                  ?><div>
                        <label for="contact-email">Email : </label>
                        <input type="email" name="contact-email" id="contact-email" placeholder="email" value="<?php echo $_SESSION['email'] ?>">
                    </div><?php
                }
                else
                {
                    ?><div>
                        <label for="contact-email">Email : </label>
                        <input type="email" name="contact-email" id="contact-email" placeholder="email">
                    </div><?php
                }?>
    <div>
        <label for="object">Object : </label>
        <input type="text" name="object" id="object" placeholder="object">
    </div>
    <div>
        <label for="message">Votre mesage : </label>
        <textarea name="message" id="message" cols="30" rows="5" placeholder="Votre message"></textarea>
    </div>
    <input type="submit" value="Envoyer">
</form>