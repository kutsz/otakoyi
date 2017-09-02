<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>book of complaints</title>
<link href="/template/css/style.css" rel="stylesheet">

</head>
<body>

<div id="app"></div><br>

<a href="/book">Book of complaints</a><br>



</script>

<script src="/template/js/react.min.js"></script>
<script src="/template/js/react-dom.min.js"></script>
<script src="/template/js/browser.min.js"></script>

<script type="text/babel">

/////////// table ///////////////////////


class Table extends React.Component{

	constructor(props) {
		super(props);

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
		<center> text</center>
		</th>
		</tr>
		{newsTemplate}

		</table>;

	}
}



/////////// pagination //////////////////



class Pagination extends React.Component{

	constructor(props) {
		super(props);
		this.state = {num: 1};
	}


componentDidMount() {

	fetch('/total').then((response) => {
		return response.text();
	}).then((text) => {
		var number = Number(text)/5;
		number = Math.ceil(number);
		this.state = {num: number};
	});

}

componentWillMount() {
	////this.state.num = 4;
}

render() {

var num = this.state.num;
var li= [];
for (var i = 1; i <= num; i++) {
	// li.push(<li key = {i} onClick={this.handleClick} data-id = {i}> <a href='#'> {i} </a> </li>);
	li.push(<li key = {i} onClick={this.props.myFunc} data-id = {i}> <a href='#'> {i} </a> </li>);

}


return (<ul className="pagination"> {li} </ul>);
}
}
//////////////////////// ASC  DESC ////////////////////////

class NameSort extends React.Component{

		constructor(props) {
			super(props);
	}

	render(){
		return(
            <div>
            <br/><br/>
		    <a href="" onClick={this.props.clicksAsc}>NAME ASC</a>
		    <br/>
		    <a href="" onClick={this.props.clicksDesc}>NAME DESC</a>
		    </div>


			)
	}

}

///-----

class EmailSort extends React.Component{

		constructor(props) {
			super(props);
	}

	render(){
		return(
            <div>
            <br/><br/>
		    <a href="" onClick={this.props.clicksAsc}>EMAIL ASC</a>
		    <br/>
		    <a href="" onClick={this.props.clicksDesc}>EMAIL DESC</a>
		    </div>


			)
	}

}

////-----

class DateSort extends React.Component{

		constructor(props) {
			super(props);
	}

	render(){
		return(
            <div>
            <br/><br/>
		    <a href="" onClick={this.props.clicksAsc}>DATE ASC</a>
		    <br/>
		    <a href="" onClick={this.props.clicksDesc}>DATE DESC</a>
		    </div>


			)
	}

}





///////////////////// app /////////////////

class App extends React.Component{

	constructor(props) {
		super(props);
//this.props = {num: 4}    // ????
this.state = {datalist: [],
              num: 2};
}

handleClick(e) {
	//e.preventDefault();

	var id =e.currentTarget.getAttribute('data-id');

	fetch("/test/page-"+id).then(function(response){
		return response.json();

	}).then((arrObj) => {

		// console.log(arrObj[2].name);
		this.setState({
	            datalist : arrObj
	        });
		// this.state.datalist = arrObj;
		// this.setState(this.state);
		//console.log(this.state.datalist[2].name);
	});


}



NameAsc(e){
	e.preventDefault();
	var arr = this.state.datalist;

	arr.sort(function (a, b) {
	  if (a.name > b.name) {
	    return 1;
	  }
	  if (a.name < b.name) {
	    return -1;
	  }
	  // a должно быть равным b
	  return 0;
	});


	this.setState({
		    datalist : arr
		   });

}


NameDesc(e){
	e.preventDefault();
	var arr = this.state.datalist;

	arr.sort(function (a, b) {
	  if (a.name > b.name) {
	    return -1;
	  }
	  if (a.name < b.name) {
	    return 1;
	  }
	  // a должно быть равным b
	  return 0;
	});

	this.setState({
		    datalist : arr
		   });

}

EmailAsc(e){
	e.preventDefault();
	var arr = this.state.datalist;

	arr.sort(function (a, b) {
	  if (a.email > b.email) {
	    return 1;
	  }
	  if (a.email < b.email) {
	    return -1;
	  }
	  // a должно быть равным b
	  return 0;
	});


	this.setState({
		    datalist : arr
		   });

}


EmailDesc(e){
	e.preventDefault();
	var arr = this.state.datalist;

	arr.sort(function (a, b) {
	  if (a.email > b.email) {
	    return -1;
	  }
	  if (a.email < b.email) {
	    return 1;
	  }
	  // a должно быть равным b
	  return 0;
	});

	this.setState({
		    datalist : arr
		   });

}

DateAsc(e){
	e.preventDefault();
	var arr = this.state.datalist;

	arr.sort(function (a, b) {
	  if (a.dateComment > b.dateComment) {
	    return 1;
	  }
	  if (a.dateComment < b.dateComment) {
	    return -1;
	  }
	  // a должно быть равным b
	  return 0;
	});


	this.setState({
		    datalist : arr
		   });

}


DateDesc(e){
	e.preventDefault();
	var arr = this.state.datalist;

	arr.sort(function (a, b) {
	  if (a.dateComment > b.dateComment) {
	    return -1;
	  }
	  if (a.dateComment < b.dateComment) {
	    return 1;
	  }
	  // a должно быть равным b
	  return 0;
	});

	this.setState({
		    datalist : arr
		   });

}




render(){
return(
    <div>
    <Table data={this.state.datalist}/>
	<Pagination  myFunc={this.handleClick.bind(this)}/>
	<NameSort clicksAsc={this.NameAsc.bind(this)} clicksDesc={this.NameDesc.bind(this)}/>
	<EmailSort clicksAsc={this.EmailAsc.bind(this)} clicksDesc={this.EmailDesc.bind(this)}/>
	<DateSort clicksAsc={this.DateAsc.bind(this)} clicksDesc={this.DateDesc.bind(this)}/>
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


