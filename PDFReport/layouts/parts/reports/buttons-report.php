<!--botão de imprimir-->
<!-- <a class="btn btn-default" title="Imprimir Resultado Documental"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-file-text-o" aria-hidden="true"></i>
</a>
<a class="btn btn-default" title="Imprimir Resultado Tecnica"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-align-justify" aria-hidden="true"></i>
</a>
<a class="btn btn-default" title="Imprimir Resultado Simiples"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-file-o" aria-hidden="true"></i>
</a> -->
<?php //dump($resource); ?>
<form action="http://localhost/pdf/gerarPdf" method="POST" target="TargetWindow">
<select name="selectRel" id="selectRel" class="" style="margin-left: 10px;">
    <option value="0">--Selecione--</option>
    <option value="1">Relação de Inscritos</option>
    <?php if($resource): ?>
        <option value="2">Resultados preliminares</option>
    <?php endif; ?>
    <option value="3">Resultados definitivos</option>
    <option value="4">Relação de contatos</option>
</select>
<input type="hidden" id="idopportunityReport" name="idopportunityReport">
<button type="submit">Gerar Rel.</button>
</form>