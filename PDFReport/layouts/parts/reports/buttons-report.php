<!--botão de imprimir-->
<a class="btn btn-default" title="Imprimir Resultado Documental"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-file-text-o" aria-hidden="true"></i>
</a>
<a class="btn btn-default" title="Imprimir Resultado Tecnica"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-align-justify" aria-hidden="true"></i>
</a>
<a class="btn btn-default" title="Imprimir Resultado Simiples"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-file-o" aria-hidden="true"></i>
</a>
<form action="http://localhost/pdf/gerarPdf" method="POST">
<input type="text" name="teste" value="teste">
<button type="submit">Enviar</button>
</form>