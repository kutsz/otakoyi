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
<div id="pagination"></div>
<div id="app"></div>




</script>

<script src="/template/js/react.min.js"></script>
<script src="/template/js/react-dom.min.js"></script>
<script src="/template/js/browser.min.js"></script>

<script type="text/babel">

/////////// table ///////////////////////

var users1 =   [
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
	email: 'user2@gmail.com',
	dateComment:'2017-07-11',
	ip: '127.0.0.1',
	browser:   'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0',
	textComment:'wwwwwww wwww wwwwwwww wwwwwwwww '
}
];


class Table extends React.Component{

	constructor(props) {
		super(props);
		//this.props = {num: 4}    // ????
		//this.state = {date: new Date()};
	}


	componentDidMount() {

	}
	componentWillUnmount() {

	}




	render() {

		var data = this.props.data;
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
}

// ReactDOM.render(
// 	<div>
// 	<Table data={users1}/>
// 	</div>,
// 	document.getElementById("forTable")

// 	);


/////////// pagination //////////////////



class Pagination extends React.Component{

	constructor(props) {
		super(props);
//this.props = {num: 4}    // ????
this.state = {datalist: []};
this.handleClick = this.handleClick.bind(this);

//this.handleClick = (e) => this.handleClick(e);

//this.handleClick = ::this.handleClick;
}


componentDidMount() {

	// 	handleClick(e) {
	// //e.preventDefault();

	// 	var id =e.currentTarget.getAttribute('data-id');

		// fetch("/test/page-"+'1').then(function(response){
		// 	return response.json();
		// 	//console.log(response.json());
		// }).then(function(arrObj){
		// 	////var arr = JSON.parse(json);
		// 	console.log(arrObj[2].name);
		// 	this.setState({
		//             datalist : arrObj
		//         });
		// 	// this.state.datalist = arrObj;
		// 	// this.setState(this.state);
		// });


	// }
}
componentWillUnmount() {

}



handleClick(e) {
	//e.preventDefault();

	var id =e.currentTarget.getAttribute('data-id');

	fetch("/test/page-"+id).then(function(response){
		return response.json();
		//console.log(response.json());
	}).then((arrObj) => {
		////var arr = JSON.parse(json);
		console.log(arrObj[2].name);
		this.setState({
	            datalist : arrObj
	        });
		// this.state.datalist = arrObj;
		// this.setState(this.state);
		console.log(this.state.datalist[2].name);
	});
}
// handleClick(e) {
// 	//e.preventDefault();

// 	var id =e.currentTarget.getAttribute('data-id');

// 	fetch("/test/page-"+id).then(function(response){
// 		return response.json();
// 		//console.log(response.json());
// 	}).then(function(arrObj){
// 		////var arr = JSON.parse(json);
// 		//console.log(arrObj[2].name);
// 		this.setState({
// 	            datalist : arrObj
// 	        });
// 		//// console.log(this.state.datalist);
// 		// this.state.datalist = arrObj;
// 		// this.setState(this.state);
// 	});


// }


render() {
//--------------------

var num = this.props.num;
var li= [];
for (var i = 1; i <= num; i++) {
	li.push(<li key = {i} onClick={this.handleClick} data-id = {i}> <a href='#'> {i} </a> </li>);
//li.push(<Li index={i}/>);  this.handleClick.bind(this)
}

//----------
/*
  var numbers = this.props.num;
  var li = numbers.map((number) =>
    <li key={number.toString()} onClick={this.handleClick}><a href='#'>
      {number}
      </a> </li>
  );
  */
//----------
return (<ul className="pagination"> {li} </ul>);
}
}

// ReactDOM.render(
// 	<div>
// 	<Pagination num="10"/>
// 	</div>,
// 	document.getElementById("pagination")

// 	);

///////////////////// app /////////////////

class App extends React.Component{

	constructor(props) {
		super(props);
//this.props = {num: 4}    // ????
this.state = {datalist: []};
}

handleClick(event) {
//e.preventDefault();

fetch("/test/page-"+i).then(function(response){
	return JSON.parse(response);
}).then(function(arr){
	console.log(arr);
	this.setState({datalist: arr})
});


}

render(){
return(
    <div>
    <Table data={users1}/>
	<Pagination num="10"/>
	</div>
	)
}

}

ReactDOM.render(
      <App/>,
	  document.getElementById("app")

	);










</script>

</body>

</html>
<!-- required -->

