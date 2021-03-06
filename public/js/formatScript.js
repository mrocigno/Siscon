$(document).ready(function(){
    $("#format-select-btn").click(function () {
        let rows = $('#table-format > tbody > tr');
        var max = 0;
        for (i = 1; i < rows.length; i++){
            let row = rows[i];
            let check = $(row).find('> td > .check-input');
            let lat = $(row).find('> td > .format-lat');
            let lng = $(row).find('> td > .format-lng');
            if($(check).is(":checked") && $(lat).val() === "" && $(lng).val() === "" ){
                max++;
                let strAddress = $(row).find('> td > .format-address').val();
                let strFAddress = $(row).find('> td > .format-faddress').val();
                let strRAddress = $(row).find('> td > .format-raddress').val();
                let strNeighborhood = $(row).find('> td > .format-neighborhood').val();
                let strCity = $(row).find('> td > .format-city').val();
                let strUf = $(row).find('> td > .format-uf').val();

                let faddress = $(row).find('> td > .format-faddress');
                let neighborhood = $(row).find('> td > .format-neighborhood');
                let zipCode = $(row).find('> td > .format-zipCode');


                let url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAgBnb9DGepdpJunK2Dxe2YgMkjLbGv30I&address=';
                if(strFAddress === ""){
                    if(strRAddress === ""){
                        url += formatAddress(strAddress) + " " +
                            (strNeighborhood === ""? "" : "- " + strNeighborhood) +
                            strCity + " - " + strUf + ", Brasil";
                    }else{
                        url += formatAddress(strRAddress) + " " +
                            (strNeighborhood === ""? "" : "- " + strNeighborhood) +
                            strCity + " - " + strUf + ", Brasil";
                    }
                }else{
                    url += strFAddress  + " " +
                        (strNeighborhood === ""? "" : "- " + strNeighborhood) +
                        strCity + " - " + strUf + ", Brasil";
                }
                console.log(url);
                searchAddress(url, faddress, neighborhood, zipCode, lat, lng)
            }
        }
        if(max > 0){
            showProgress(max);
        }
    });
});

function searchAddress(url, faddress, neighborhood, zipCode, lat, lng, callback){
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            plusValueProgress();
            let results = data.results;
            let components = results[0].address_components;
            if(results.length > 0){
                $(lat).val(results[0].geometry.location.lat);
                $(lng).val(results[0].geometry.location.lng);
                for(i = 0; i < components.length; i++){
                    var component = components[i];
                    if($.inArray("sublocality_level_1", component.types) !== -1){
                        $(neighborhood).val(component.long_name);
                    }
                    if($.inArray("postal_code", component.types) !== -1){
                        $(zipCode).val(component.long_name);
                    }
                    if($.inArray("route", component.types) !== -1){
                        $(faddress).val(component.long_name);
                    }
                }
                callback();
            } else {
                console.log("não encontrado");
            }
        },
        error: function () {
            plusValueProgress();
        }
    });
}

function formatAddress(address) {
    let abrv = [
        "V1%CVILA",
        "JD1%CJARDIM",
        "S1%CSAO",
        "STA1%CSANTA",
        "STO1%CSANTO",
        "CH1%CCHACARA",
        "J.NUNES1%CJOSE NUNES",
        "ENG1%CENGENHEIRO",
        "PQ1%CPARQUE",
        "PT1%CPONTE",
        "VL1%CVILA",
        "VE1%CVIELA",
        "TV1%CTRAVESSA",
        "R1%CRUA",
        "AV1%CAVENIDA",
        "DR1%CDOUTOR",
        "SEN1%CSENADOR",
        "ES1%CESTRADA",
        "PDE1%CPADRE",
        "PC1%CPRACA",
        "DESEM1%CDESEMBARGADOR",
        "MAJ1%CMAJOR",
        "PROF1%CPROFESSOR",
        "PROFA1%CPROFESSORA",
        "CAP1%CCAPITRAO",
        "MAL1%CMARECHAL",
        "SOUSA1%CSOUZA",
        "CEL1%CCORONEL",
        "EMB1%CEMBAIXADOR"
    ];

    var formated = "";

    let splitedAddress = address.split(" ");
    splitedAddress.forEach(function (str) {
        abrv.forEach(function (ab) {
            let splitedAb = ab.split("1%C");
            if(splitedAb[0] === str){
                str = splitedAb[1];
            }
        });
        formated += " " + str;
    });
    return formated.trim();
}

function confirmSubmit(){
    let rows = $('#table-format > tbody > tr');
    for (i = 1; i < rows.length; i++) {
        let row = rows[i];
        let strAddress = $(row).find('> td > .format-address').val();
        let strLat = $(row).find('> td > .format-lat').val();
        let strLng = $(row).find('> td > .format-lng').val();
        let strFAddress = $(row).find('> td > .format-faddress').val();
        let strRAddress = $(row).find('> td > .format-raddress').val();
        let strNeighborhood = $(row).find('> td > .format-neighborhood').val();
        let strCity = $(row).find('> td > .format-city').val();
        let strUf = $(row).find('> td > .format-uf').val();
        let strZipCode = $(row).find('> td > .format-zipCode').val();
        $(row).find('> td > .formatted-values').val(strAddress + "1%C" + strLat + "1%C" + strLng + "1%C" + strFAddress + "1%C" + strRAddress + "1%C" + strNeighborhood + "1%C" + strCity + "1%C" + strUf + "1%C" + strZipCode);
    }
   submitYesNo('save-formated');
}