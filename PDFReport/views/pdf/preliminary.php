<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
    $opp = $app->view->jsObject['opp'];
    // dump($opp->registrationCategories);
    // dump($sub);
    // foreach ($opp->registrationCategories as $key => $nameCategory) {
    //     echo "Categoria: ".$nameCategory."\n";
    //     foreach ($sub as $campo => $valor) {
    //         //dump($valor->category);
    //         if($nameCategory == $valor->category){
    //             $agent = $app->repo('Agent')->find($valor->owner->id);
    //             dump($agent->name);
    //         }
    //     }
    // }
    // die();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
.activeTr{
    background-color: #c3c3c3;
    /* border: 1px solid black; */
    margin-top: 15px;
    color: saddlebrown;
    border-radius: 5px;
}


</style>
<div class="container">
    <table width="100%" >
        <thead>
            <tr class="text-center">
                <td>
                    <img src="https://servicos.esp.ce.gov.br/eventos/2017/eve022017cenic/images/logo_espce.png" alt=""
                        style="width: 200px">
                </td>
                <td>
                    <img src="https://coronavirus.ceara.gov.br/wp-content/uploads/2020/03/logo_espce_gov-2.png" alt="" style="width: 200px">
                </td>
            </tr>
        </thead>
    </table>
    <table width="100%">
        <tr class="text-center">
            <td>
                <h4><?php echo $app->view->jsObject['title']; ?></h4>
            </td>
        </tr>
        <tr class="text-center">
            <td><?php echo $nameOpportunity; ?></td>
        </tr>
    </table>
    <br>
    <table class="table table-striped table-bordered">
        <thead>
        <?php foreach ($opp->registrationCategories as $key => $nameCategory) { ?>
        <tr class="activeTr">
        <th colspan="3">
            <?php echo $nameCategory; ?>
        </th>
        </tr>
            <tr style="background-color: #009353; color:white">
                <th>Inscrição</th>
                <th>Nome</th>
                <th>Nota</th>
            </tr>
            <?php 
            foreach ($sub as $key => $value) {
                if($nameCategory == $value->category){ ?>
            <tr>
                <td><?php echo $value->number; ?></td>
                <td><?php echo $value->owner->name; ?></td>
                <td><?php echo $value->preliminaryResult; ?></td>
            </tr>
            <?php }else{?>
                <tr>
                    <td  colspan="3">Nao existe</td>
                
                </tr>
            <?php 
            //break; 
            }
            } 
        } ?>
        </thead>
       
    </table>
</div>
<?php 
    die;
    ?>