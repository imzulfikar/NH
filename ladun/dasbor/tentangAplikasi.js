var divTentangAplikasi = new Vue({
    el : '#divTentangAplikasi',
    data : {
        timPengembang : [
            {nama : 'Hasnah Nur Ardita', pos : 'Project Manager & Front End', pic : 'http://localhost/Nadha-Resto/dasbor/img/devTeam/hasnah_ardita.jpg', email : 'alditha.forum@gmail.com'},
            {nama : 'Aditia Darma Nst', pos : 'Backend Dev', pic : 'aditia_darma.jpg', email : 'siti.okthary@gmail.com'},
            {nama : 'Adam Falizufa Sagara', pos : 'Microservice', pic : 'adam_flz.png', email : 'adamflz@gmail.com'}
        ]
    } 
});

var listKontributor = '';

$.post('http://api.haxors.or.id/haxors-product/contributors/getContributors.php', function(data){
    let obj = JSON.parse(data);
    console.log(obj);
    obj.forEach(renderList);

    function renderList(item, index){
        listKontributor = listKontributor + obj[index].nama + " - ";
    }

});

setTimeout(function(){
    $('#capContributors').html(listKontributor);
}, 500);