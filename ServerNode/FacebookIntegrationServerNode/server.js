var sparql =  require('sparql');
var mongoClient = require('mongodb').MongoClient;
var timescheduler = 1000 * 3600 ; // 10sec


function Votazioni(){
    client.query( " SELECT distinct * WHERE { " +
                    "?votazione a ocd:votazione; dc:date ?date;   dc:title ?title; dc:description ?description;" +
                    " dc:relation ?relazione;  ocd:votanti ?votanti; ocd:richiestaFiducia ?richiestaFiducia; ocd:approvato ?approvato; ocd:favorevoli ?favorevoli;" +
                    "ocd:contrari ?contrari; ocd:astenuti ?astenuti ; <http://www.w3.org/2000/01/rdf-schema#label> ?label ;" +
                    "ocd:rif_leg ?rif_leg; ocd:votazioneSegreta ?votazioneSegreta ; ocd:votazioneFinale ?votazioneFinale " +
                    "  } ORDER BY ASC(?date) LIMIT 100", function(err, res){
        res.results.bindings.forEach(function(row){
            console.log(row.title.value)
            InsMongo(row);
        })
        console.log("End Lettura Votazioni");
    });
 };


function InsMongo( row  ){
  //mongoClient.connect('mongodb://10.112.0.116:27017/hackathon', function(err, db) {
  mongoClient.connect('mongodb://localhost:27017/hackathon', function(err, db) {
    var mrow =   map(row) ;
    var jsVotazione= {  'data' : mrow ,
                        '_id' :  mrow['votazione']
                         };
        console.log(jsVotazione);
	delete jsVotazione._id;
        db.collection("votazioni").update({'_id' :  mrow['votazione'] } ,{'$set':jsVotazione}, {upsert:true}, function(err, result) {
            if(err){
                console.log(err);}
            db.close();
        });
    });
}

function map(o){
            var res = {};
            for(var key in o)
            {
                if(o[key].datatype =='http://www.w3.org/2001/XMLSchema#integer' ){
                    res[key]=parseInt(o[key].value);
                }else
                    res[key] =o[key].value;
            };

    return res;
}

//console.log("Start Server Diego");

var client = new sparql.Client('http://dati.camera.it/sparql');

Votazioni();

setInterval(function(){
    console.log('Scheduler');
    Votazioni();

},timescheduler);


//console.log("End Server Diego");

