<?php

    // INIT VARS FOR HEADER AND FOOTER
    $isForm = "YES";

    $header_vars = array(
        "js_includes" => "
        <script type=\"text/javascript\" src=\"app/js/inschrijving_forms.js\"></script>
        <script type=\"text/javascript\" src=\"app/js/preload.js\"></script>
        <script type=\"text/javascript\" src=\"app/js/validate.js\"></script>
        ",
        "isForm" => $isForm
    );
    $footer_vars = array(
        "isForm" => $isForm
    );

    
    // CLEAR FORM RELATED SESSIONS
    unset($_SESSION['id_leerling']); 
    unset($_SESSION['stroom']); 
    unset($_SESSION['id_inschrijving']); 
    unset($_SESSION['volgnummer_b']); 
    unset($_SESSION['volgnummer_a']); 
    unset($_SESSION['afspraak_dag']); 
    unset($_SESSION['afspraak_uur']); 
    unset($_SESSION['volgnummer']); 
                
    
    // GET STEPS
    include("app/form_structures/{$_GET['f']}.php");
    
    
    // PUT STEP SLIDES IN OB      
    ob_start();
    foreach($steps as $nr => $step){
    
        // STEPS OVERVIEW
        $active = $i++ == 0 ? " active" : "";        
        $steps_overview .= "<div titel=\"{$step['titel']}\" class=\"$active\">{$nr}</div>";

        
        // STEPS CONTAINERS - SLIDES
        $validate = $step['validate'] != "" ? "validate=\"{$step['validate']}\"" : "";
                                
        echo "<div class=\"vak\" $validate preload=\"{$step['preload']}\">";
            include("app/views/forms/".$step['tpl']);
        echo "</div>";        
    }
    
    $steps_containers = ob_get_clean();
    $step_start_title = $steps[1]['titel'];
    
    $header_vars['titel'] = $titel;

    $form_vars = array(
        "steps_overview" => $steps_overview,
        "steps_containers" => $steps_containers,
        "step_start_title" => $step_start_title
    );
    
    // START PAGE
    Template::view("core/header",$header_vars);
    Template::view("core/form_builder",$form_vars);
    Template::view("core/footer",$footer_vars);

?>
