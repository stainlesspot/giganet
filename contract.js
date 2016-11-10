$(document).ready(function (){
    var networkLabel = $('.networkLabel'), networkInfo = $('.networkInfo');
    networkLabel.css('left', (networkInfo.width() - networkLabel.width() - 5) / 2);
    //networkLabel.css('top',-1 * (networkLabel.height()) / 2);
});