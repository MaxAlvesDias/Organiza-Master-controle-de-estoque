var rel1 = new Chart(document.getElementById("rel1"), {
	type:'line',
	data:{
		labels:days, 
		datasets:[{
			label:'Receita',
			data:revenue_list,
			fill:false,
			backgroundColor:'#36A2EB',
			borderColor:'#36A2EB'
		},
		{
			label:'Despesas',
			data:expenses_list,
			fill:false,
			backgroundColor:'#FF6384',
			borderColor:'#FF6384'
		}]
	}
});

var rel2 = new Chart(document.getElementById("rel2"), {
	type:'pie',
	data:{
		labels:status_name,
		datasets:[{
			data:status_list,
			backgroundColor:['#FFCE56', '#36A2EB', '#FF6384']
		}]
	}
});

