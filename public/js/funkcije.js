function parentChosen()
{
    var izbor = $("#parent-select").val()-1;
    // if(izbor==-1)  // ako nije odabrana nijedna kategorija iz padajuce liste
    // {
    //     $("#novaKategorijaNatpis").css("color", "white");
    //     $("#unosNoveKategorije").removeAttr('disabled');
    //
    //     $("#slikaKategorijeNatpis").css("color", "white");
    //     $("#slikaKategorije").removeAttr('disabled');
    //
    //     $("#unosNoveVrste").removeAttr('disabled');
    //     $("#novaVrstaNatpis").css("color", "white");
    //
    //     //$("#vrstaProizvoda").attr('disabled','disabled');
    //
    //     return false;
    // }

    if (izbor>-1)  // ako je odabrana roditelj iz padajuce liste
    {

        //$("#student_email").attr('disabled','disabled');
        //$("#student_phone").attr('disabled','disabled');
        //$("#student_address").attr('disabled','disabled');
        $("#student_email").removeAttr('required');
        $("#student_phone").removeAttr('required');
        $("#student_address").removeAttr('required');

    }


}
// =============================================================
