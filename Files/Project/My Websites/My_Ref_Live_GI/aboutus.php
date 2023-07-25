<?
function main(){
?>


<div class="container_fluid profile_head">
    <div class="container">
            <h3>Company Profile</h3>
    </div>
</div>



<div class="container_fluid about_detail">
    <div class="container">
        
        <p>Established in the year 2014, we, <span style="color:#de5488; font-family: 'latosemibold';">"GREEN INDIA ECO PRODUCTS"</span> are engaged in manufacturing, marketing and supplying better, improved and Eco-friendly Wall Putty. 
        Based in Coimbatore (Tamil Nadu), India ours is private limited company. Owing to the efficient working methodology of our professionals, we have streamlined 
        our business operations. We make sure that the raw materials used are of finest grade to ensure the high performance of our products. Excellent resistivity 
        properties of our products have made them a favored choice of millions.</p>
        
        <p>From the time of our commencement, we have been a client-centric organization, which strongly believes that the path to a prosperous business is led by 
        accomplishing maximum client satisfaction. For this, we strive to offer our clients with a product that meets with their variegated needs and demands. We also 
        offer customized packaging solutions to our clients and ensure that they receive all consignments within the promised time frame. Due to these reasons, we have 
        augmented a huge clientele across Indian Subcontinent.</p>
        
        <p>Under the leadership and guidance of our mentor, <span style="color:#de5488; font-family: 'latosemibold';">'Mr. Veerasami Subramaniam'</span>, we have created a sophisticated niche for ourselves in this competitive market. His 
        detailed industry knowledge, charismatic managerial skills and vibrant leadership qualities have enabled us to win the faith of numerous patrons. </p>
        
        
        <div class="about_tab">
            <div class="row abouttab_head">
                <h4 class="active" id="show_portfolio"><span>Sophisticated</span> Manufacturing Unit</h4>
                <h4 id="show_clientele">Our Team</h4>
                <h4 id="show_client_satisfy">Client Satisfaction</h4>
            </div>
            
            <p class="portfolio_parag">We have state-of-the-art infrastructure, which capable us to cater to the specific needs and requirements of construction industry. 
            Our manufacturing unit is stretched in over 24000 sq.ft area. It is operational with several latest heavy-duty machines and equipments. Manufacturing 
            unit is assisted by skilled and professionally trained personnel who are well-versed with the latest technologies and modern machines. Our chemical experts 
            handle the production procedures efficiently and guide other personnel to execute the production procedure smoothly</p>
            
            <p class="clientele_parag">We firmly believe that the most valuable asset possessed by any company is its manpower. Hence, we, Green India Eco Products are 
            highly dedicated to offer a healthy environment conductive to human safety and pleasant working atmosphere for the welfare of all our employees. Our company 
            has efficient team of chemical engineers, quality controllers who make stirring efforts to produce unbeatable cement paints and acrylic emulsions. Our sales 
            and marketing team is always ready with cost-efficient solutions for our clients and is a resource for new idea, trouble-shooting, and practical problem prevention.</p>
            
            <p class="client_satisfy_parag">Unmatched quality and the complete satisfaction of the customers is the backbone of every company. Hence, we perform pre and 
            post-production quality test before supplying to the customers for ensuring customers' satisfaction. In order to achieve perfectness of Wall Putty, Green 
            India Eco Products uses only superior raw materials and latest manufacturing process based on Japanese technology. We always develop our product as per the 
            specific requirements of our clients. Our high quality wall putty is repeatedly demanded by our clients based all over India especially in Tamil Nadu.</p>
        </div>
        
    </div>
</div>


<div class="container_fluid">
	<? include "testimonial.php"; ?>
</div>


<script type="text/javascript">

$(".testimonial_right p").prepend("<img src='images/quote1.png' alt='' align='top' />");
$(".testimonial_right p").append("<img src='images/quote2.png' alt='' align='absmiddle' />");

$(".abouttab_head h4").click( function() {
	$(".abouttab_head h4").removeClass('active');
	$(this).addClass('active');
});

$("#show_portfolio").click( function() {
	$(".portfolio_parag").show();
	$(".clientele_parag").hide();
	$(".client_satisfy_parag").hide();
});


$("#show_clientele").click( function() {
	$(".clientele_parag").show();
	$(".portfolio_parag").hide();
	$(".client_satisfy_parag").hide();
});


$("#show_client_satisfy").click( function() {
	$(".clientele_parag").hide();
	$(".portfolio_parag").hide();
	$(".client_satisfy_parag").show();
});


</script>


<?
}
include "template.php";
?>