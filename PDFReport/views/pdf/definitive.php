<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
    $opp = $app->view->jsObject['opp'];
    $verifyResource = $this->verifyResource($this->postData['idopportunityReport']);
    $claimDisabled = $app->view->jsObject['claimDisabled']; 
?>

<div class="container">
    <?php include_once('header.php'); ?>
    <table width="100%">
        <tr class="text-center">
            <td class="fontArial">
                <h4><?php echo $app->view->jsObject['title']; ?></h4>
            </td>
        </tr>
        <tr class="text-center fontArial">
            <td style="margin-left:2px;"><?php echo $nameOpportunity; ?></td>
        </tr>
    </table>
    <br>
    <?php 
        //REDIRECIONA PARA OPORTUNIDADE CASO NÃO HAJA CATEGORIA        
        $type = $opp->evaluationMethodConfiguration->type->id;
        //NAO TEM RECURSO OU DESABILITADO
        if(empty($claimDisabled) || $claimDisabled == 1) {
            // nao tem categoria, tecnica e nao tem recurso 
            if($opp->registrationCategories == "" &&  $type == 'technical'){
                include_once('technical-no-category.php');
            }elseif($opp->registrationCategories == "" &&  $type == 'simple'|| $type == 'documentary'){
                include_once('simple-documentary-no-category.php');
            }
            // tem categoria, tecnica e nao tem recurso
            if($opp->registrationCategories !== "" &&  $type == 'technical' ){
                include_once('technical-category.php');
            }elseif($opp->registrationCategories !== "" &&  $type == 'simple' || $type == 'documentary'){
                include_once('simple-documentary-category.php');
            }
        }else 
        //SE TIVER RECURSO
        if($sub[0]->canUser('sendClaimMessage')){
           

            // if($opp->registrationCategories !== "" &&  $type == 'technical'){
            //     include_once('technical-category.php');
            // }
            
        }
    ?>

</div>
<?php 
    //die;
?>
