@extends('templates.crud')


@section('body')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jquery library -->
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <!-- colorpicker library -->
    <link rel="stylesheet" href="css/colorpicker.css" type="text/css" />
    <script type="text/javascript" src="js/colorpicker.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>pilin</title>
</head>
<style>

</style>
<body>
<div class="input-group flex-nowrap">
    <span class="input-group-text" id="addon-wrapping">Background Color</span>
    <input type="text" maxlength="10" class="form-control" placeholder="Introduce un Color" aria-label="Color" value="#ff0000" id="colorpickerField" aria-describedby="addon-wrapping">
</div>
<p>
    <input class="btn btn-success" type="submit" value="Aplicar Color" onclick="changeBackgroundColor()">
    <button class="btn btn-primary" onclick="setRandomBackgroundColor()">Color Aleatorio</button>
</p>

<script>
$(function() {
    $('#colorpickerField').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).val('#' + hex);
            $(el).ColorPickerHide();
            changeBackgroundColor();
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor(this.value);
        }
    })
    .bind('keyup', function(){
        $(this).ColorPickerSetColor(this.value);
    });
});

function changeBackgroundColor() {
    var color = $('#colorpickerField').val();
    if(/^#[0-9A-F]{6}$/i.test(color) || isColorNameValid(color)) {
        $('body').css('background-color', color);
    } else {
        alert('Pon un color correcto');
    }
}

function isColorNameValid(colorName) {
    var s = new Option().style;
    s.color = colorName;
    return s.color !== '';
}

function setRandomBackgroundColor() {
    var randomColor = '#' + Math.floor(Math.random()*16777215).toString(16);
    $('body').css('background-color', randomColor);
    $('#colorpickerField').val(randomColor);
}
</script>

</body>
</html>
@endsection
