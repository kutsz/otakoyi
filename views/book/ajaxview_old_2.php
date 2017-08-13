<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>book of complaints</title>
	<link href="/template/css/style.css" rel="stylesheet">
	<script src="/template/js/jquery-3.2.1.min.js"></script>

</head>
<body>



<table>

	<tr id = "tr">
		<th>
			<center> name </center>
		</th>
		<th>
			<center> email </center>
		</th>
		<th>
			<center> date </center>
		</th>
		<th>
			<center> ip </center>
		</th>
		<th>
			<center> browser </center>
		</th>
		<th>
			<center> text</center>
		</th>
	</tr>
	<?php for ($i = 0; $i < 5; $i++): ?>
		<tr id="tr<?php echo $i; ?>">
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>
	<?php endfor;?>

</table> <br>

<a href="">NAME ASC</a><br>
<a href="">NAME DESC</a><br><br>
<a href="">EMAIL ASC</a><br>
<a href="">EMAIL DESC</a><br><br>
<a href="">DATA ASC</a><br>
<a href="">DATA DESC</a><br><br>
<!-- Постраничная навигация -->
<?php echo $pagination->get(); ?><br><br>


<a href="/book">Book of complaints</a><br>

<h2 id='num'></h2>

<textarea id="tx" style="display:none;"></textarea>
<textarea name="hide" style="display:none;"></textarea>


<!-- ********************react test***********************-->



<div id="forTable"></div>
<div id="content"></div
	<!-- *******************************************-->






	<script>

var glob = {};

		$(document).ready(function(){
			//---------------------------------------------
			$(".pagination li").click(function () {
				var id = $(this).attr("data-id");
				//$(this).addClass('active');
				//alert("data-id = " + id);
				$.ajax({
					url:"/test/page-"+id,
					type: 'POST',
					//type:'GET',
					//dataType: 'json',
					//data:{},
					//data: json,
					contentType: 'application/json; charset=utf-8',
					success: function(data){
						var arr = JSON.parse(data);

						$('#tx').text(data);
						glob.data = data;

						if(data){
							var len = arr.length;
							$('#hidden').val(len);
							for(let i=0; i<len; i++){

								$('#tr'+i+'>td:nth-child(1)').text(arr[i]['name']);
								$('#tr'+i+'>td:nth-child(2)').text(arr[i]['email']);
								$('#tr'+i+'>td:nth-child(3)').text(arr[i]['dateComment']);
								$('#tr'+i+'>td:nth-child(4)').text(arr[i]['ip']);
								$('#tr'+i+'>td:nth-child(5)').text(arr[i]['browser']);
								$('#tr'+i+'>td:nth-child(6)').text(arr[i]['textComment']);

							}



						}
					},

				});
				return false;
			});


	//-----------------------------------------------

// 	var elements = document.querySelectorAll('.pagination li');

// 	var gl = 77;

// 	for (var i = 0; i < elements.length; i++) {
// 		//var valAttr = elements[i].getAttribute('data-id');

// 		elements[i].onclick = function(eventObj,gl){
// 			var li = eventObj.target;
// 			//var valAttr = li.getAttribute('data-id');
// 			var d = li.getAttribute('data-id');
// 			//alert(d);
// 			//document.getElementById('num').innerHTML = gl;

// 			var ajax = new XMLHttpRequest();

// 			ajax.onreadystatechange = function() {
// 				if (ajax.readyState == 4 && ajax.status == 200) {
// 					gl =ajax.responseText;
// 					//document.getElementById('num').innerHTML = gl;
// 				}
// 			};
// 			var id = 3;
// 		    var url = "/test/page-"+id;
// 			ajax.open('GET', url, true);
// 			ajax.send();
// 		}

// 		gl = 1000;
// 			//document.getElementById('num').innerHTML = gl;
// 	}
// document.getElementById('num').innerHTML = gl
	//-------------------------------
});

	//var str = $('#tx').text();
//alert(str);
</script>

<script src="/template/js/react.min.js"></script>
	<script src="/template/js/react-dom.min.js"></script>
	<script src="/template/js/browser.min.js"></script>

<script type="text/babel">


		var users =   [
		{
		name: 'Саша',
		email: 'user1@gmail.com',
		dateComment:'2017-07-11',
		ip: '127.0.0.1',
		browser:   'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0',
		textComment:'qqqqqq qqqqqqq qqqqqqqq q '

	},
	{
	name: 'User2',
	email: 'user1@gmail.com',
	dateComment:'2017-07-11',
	ip: '127.0.0.1',
	browser:   'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0',
	textComment:'wwwwwww wwww wwwwwwww wwwwwwwww '
},
{
	name: 'Bill',
	email: 'user3 @gmail.com',
	dateComment:'2017-07-11',
	ip: '127.0.0.1',
	browser:   'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0',
	textComment:'eeeeeeeee eeeeeee eeeeeeee eeeeeeeee'
}
];

var Table = React.createClass({



getInitialState: function() {
return {data: users};
},



render: function() {


//var data = this.state.data;
var newsTemplate;
newsTemplate = data.map(function(item, index){
return (
<tr key = {index}>
	<td>{item.name} </td>
	<td>{item.email}</td>
	<td>{item.dateComment} </td>
	<td>{item.ip} </td>
	<td>{item.browser} </td>
	<td>{item.textComment} </td>
</tr>
)

});

return <table>
<tr id = "tr">
	<th>
		<center> name </center>
	</th>
	<th>
		<center> email </center>
	</th>
	<th>
		<center> date </center>
	</th>
	<th>
		<center> ip </center>
	</th>
	<th>
		<center> browser </center>
	</th>
	<th>
		<center> text</center>
	</th>
</tr>
{newsTemplate}

</table>;

}

});

ReactDOM.render(
<div>
	<Table data={users}/>
</div>,
document.getElementById("forTable")
);


//-----------


var Pagination = React.createClass({
render: function() {
var num = this.props.num;
var li= [];
for (var i = 0; i < num; i++) {
  li.push(<li key = {i}> <a href='#'> i </a> </li>);
}

return (<ul> {li} </ul>);
}
});

ReactDOM.render(
<div>

	<Pagination num="4"/>

</div>,
document.getElementById("content")

);


/*
var Pagination = React.createClass({
render: function() {
return <?php echo "<h1> My name is {this.props.name} and I love {this.props.action}! </h1>"; ?> ;
}
});

ReactDOM.render(
<div>

	<HelloWorld name="Katya" action="football"/>
	<HelloWorld name="Vasya" action="walking"/>
	<HelloWorld name="Ivan" action="swimming"/>

</div>,
document.getElementById("content")

);

*/

</script>

</body>

</html>
<!-- required -->

