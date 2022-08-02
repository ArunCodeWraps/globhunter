<?php 
include("../include/config.php");
include("../include/functions.php"); 
$id = $_REQUEST['id'];
$sql = $obj->query("select user_id,net_payment from $tbl_salary where id='$id'");
$result = $obj->fetchNextObject($sql);
?>
<div class="box-body paymentdetailfrm">
    <form name="customerfrm" id="customerfrm" method="POST">
        <input type="hidden" name="c_id" id="c_id" value="<?php echo $id; ?>">
        <div class="row">
            <div class="col-lg-6 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <input class="mdl-textfield__input" type="text" id="commition" name="commition" value="" placeholder="Commition">                
                <span class="errMsg"></span>
            </div>
        </div>
        <div class="col-lg-12 p-t-20 text-center">
            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary" id="paymentbtn">Submit</button>
        </div>
    </div>
</form>
</div>
<script type="text/javascript">
$("#paymentbtn").click(function(){
    commition = $("#commition").val();
    if(commition!=''){
        $("#paymentbtn").html("Waiting...");
        c_id = $("#c_id").val();

        $.ajax({
            url:"ajax/jobcommitionadd.php",
            type:"POST",
            data:{id:c_id,commition:commition},
            success:function(data)
            {
                if(data==1){
                    $("#customerfrm").hide();
                    $(".paymentdetailfrm").html("<h4 style='color:green'>The commition is sucessfully updated of this Job.</h4>");
                    setTimeout(function(){
                        $("#commitionModal").hide();
                    }, 3000);
                    location.reload();
                }
            }
        })
    }else{
        $(".errMsg").html("<h4 style='color:red'>Required Field!.</h4>");
    }
})
</script>
