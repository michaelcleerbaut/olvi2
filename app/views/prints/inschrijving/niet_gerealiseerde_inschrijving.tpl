<div style="border-bottom: solid thin #000;height: 80px;position: relative;">
    <img src="/public/img/olvi_logo.png" width="80" style="position: absolute;margin-left:100px;" />
    
    <div style="float:left;">
        <span style="font-size:14px;">OLVI-MIDDENSCHOOL BOOM</span><br>
        Brandstraat 44<br>
        2850 Boom    
    </div>
            
    <table style="float:right;">
        <tr><td style="width:120px;">Inschrijvingsnummer:</td><td><strong><?=$leerling['volgnummer'];?></strong></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td>Datum:</td><td><?=date("d-M-Y");?></td></tr>
    </table>
</div>

<h2 style="text-align:center;">Niet gerealiseerde inschrijving B Stroom</h2>



    <p style="margin-top:80px;width:100%;">
        Uw kind werd geregistreerd op de lijst <strong>'niet gerealiseerde inschrijvingen'</strong> voor het <strong>B Jaar</strong>.<br>
        Dit wil zeggen dat hij/zij momenteel NIET ingeschreven kan worden voor het B Jaar.
    </p>
    
    <p>
        Van zodra er plaats vrij is voor het b jaar wordt u gecontacteerd door de directie van de school via onderstaande gegevens.<br>        
    </p>
    
    <p>
        <table class="formulier">
            <tr><th>Telefoon</th><td><?=$leerling['tel'];?></td></tr>
            <tr><th>Email</th><td><?=$leerling['email'];?></td></tr>
        </table>
    </p>

