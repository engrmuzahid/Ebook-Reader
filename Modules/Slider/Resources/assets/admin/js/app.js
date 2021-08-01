import Slider from './Slider';

new Slider();

$('#autoplay').on('change', (e) => {
    $('.autoplay-speed-field').toggleClass('hide');
});

$('.color-picker').spectrum({
    type: "text",
    togglePaletteOnly: "true",
    hideAfterPaletteSelect: "true",
    showInput: "true",
    showInitial: "true"
});