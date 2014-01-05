<div class="subtitel">Gelieve in te loggen</div>

<?=$login_error?>

<form method="post" action="">
<input type="hidden" name="action" value="login">
<table class="formulier">
    <tr><th>Gebruiker</th><td><input type="text" name="gebruiker" value="<?=$username?>"></td></tr>
    <tr><th>Wachtwoord</th><td><input type="password" name="wachtwoord" value=""></td></tr>
    <tr><th></th><td><div class="btnBig btnBigActive submit">Inloggen</div></td></tr>
</table>
</form>