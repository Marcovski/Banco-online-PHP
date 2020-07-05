{% extends 'interna/partials/partial.twig.php' %}

{% block title %}Saque{% endblock %}

{% block body %}

<div>
    <form action="{{BASE}}?url=depositar" id="frmSaque" method="post">
    <div class="grid-50">
        <label for="txtValor">
            Valor a ser sacado
        </label>
        <input type="text" id='txtValor' name="txtValor">
        <input type="hidden" id="txtSaldo" name="txtSaldo" value="{{saldo | number_format(2, '.', ',')}}">
        <input type="submit" class="btn " value="Sacar">
    </div>
    <div class="grid-50 mens">
        <h2>Saldo atual:<span style="color:rgb(53, 102, 236);"> R${{saldo | number_format(2, '.', ',')}} </span></h2>
    </div>
    <div class="clear"></div>
    </form>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{BASE}}assets/js/jquery.mask.min.js"></script>
<script>
    $('#txtValor').mask('000.000.000.000.000,00',{
        reverse: true 
    });

</script>

{% endblock %}