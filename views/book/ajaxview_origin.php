<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>book of complaints</title>
	<link href="/template/css/style.css" rel="stylesheet">
	<script src="/template/js/jquery-3.2.1.min.js"></script>

</head>
<body>

	<script>

		$(document).ready(function(){
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
		});





	</script>


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


	<!-- ********************react test***********************-->



	<div id="forTable"></div>
	<div id="content"></div
	<!-- *******************************************-->

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

var Tablle = React.createClass({

loadCommentsFromServer: function() {
    $.ajax({

      url:"/test/page-"+id,
	  type: 'POST',
	  contentType: 'application/json; charset=utf-8',
      success: function(data) {

        var users1 = JSON.parse(data);
        this.setState({data: users1});

      }.bind(this)

    });
  },

  getInitialState: function() {
    return {data: users};
  },

  componentDidMount: function() {

    this.loadCommentsFromServer();

  },


render: function() {

//var data = this.props.data;
var data = this.state.data;
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

var HelloWorld = React.createClass({
            render: function() {
                 return <?php echo "<h1> My name is {this.props.name} and I love {this.props.action}! </h1>"; ?>;
            }
        });

 var Test = React.createClass({
            render: function() {
                 return <div><?php echo $pagination->get(); ?></div>;
            }
        });

ReactDOM.render(
<div>
	<Tablle data={users}/>
	<HelloWorld name="Nas" action="eati"/>
<Test/>
 </div>,
document.getElementById("forTable")
);

//-----------

/*
var HelloWorld = React.createClass({
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

            <Test />
        );
        */

</script>

</body>

</html>
<!-- required -->

