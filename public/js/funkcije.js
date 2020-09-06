jQuery(document).ready(function($){

//================================= IZBOR grupe na osnovu ID studenta
    $("#student_id").change(function (e){

        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        let izbor = $("#student_id").val();
        if (izbor==0) return false
        else {

            $.ajax({
                type: "POST",
                url: '/admin/payments/ajax-get-groups',
                data:{izbor:izbor},
                success:function (data){
                  console.log(data);
                  console.log(typeof data)
                    let response = data.groups;
              //    console.log(typeof response);
              //    console.log(response);
                    let prikaz = $("#courses");
                    $("#courses_div").slideDown();
                    prikaz.empty();
                    prikaz.append("<option value='0'> -- izaberite grupu -- </option> ");
                    for(let i=0; i<response.length; i++) {
                        console.log(response[i].group_id);
                        prikaz.append("<option value='"+response[i].id+"'>" +response[i].name + "</option>");
                    }
                }
            });
        }

    });



//================================= DOBIJANJE UPLATA nakon izbora grupe

$("#courses").change(function (e){

    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    let student = $("#student_id").val();
    let izbor = $("#courses").val();
    if (izbor==0) return false
    else {

        $.ajax({
            type: "POST",
            url: "/admin.payments/ajax-get-payments",
            data:{izbor:izbor, student:student},
            success:function(data){
                //console.log(data);
                console.log(typeof data)
                let price = data.course_price;
                console.log(price);
                let response = data.payments;
                   console.log(typeof response);
                   console.log(response);

                $("#payments_table_div").slideDown();

                let prikaz = $("table tbody");
                prikaz.empty();

                let dug = price[0].price - response[0].amount;

                for(let i=0; i<response.length; i++) {
                    console.log(dug);
                    prikaz.append("<tr>" +
                        "<td>"+ response[i].created_at +"</td>" +
                        "<td>"+ response[i].amount+ "</td>" +
                        "<td>"+ dug + "</td>" +
                        "</tr>");
                    dug = dug - response[i].amount;
                }

            }
        });
    }

});






}); // zatvoren dokument!






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







