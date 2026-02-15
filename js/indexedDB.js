var fichasLibros=function(user){//private members
	var db=null,name=null,version=null,pais_cli=null,
		trace=function(msg){//Traces
			console.log(msg);
		},
		init=function(dbname,dbversion,pc){
			(pc?pais_cli=pc:'');
			name=dbname;//1.Initialize variables
			version=dbversion;
			if (compatibility()){//2. Make indexedDB compatible
				//deletedb(dbname);//2.1 Delete database
				open(name);//3.Open database
			}
		},
		compatibility=function(){
/*			trace("window.indexedDB: " + window.indexedDB);
			trace("window.mozIndexedDB: " + window.mozIndexedDB);
			trace("window.webkitIndexedDB: " + window.webkitIndexedDB);
			trace("window.msIndexedDB: " + window.msIndexedDB);

			window.indexedDB = window.indexedDB || window.webkitIndexedDB || window.mozIndexedDB;

			trace("window.IDBTransaction: " + window.IDBTransaction);
			trace("window.webkitIDBTransaction: " + window.webkitIDBTransaction);
			trace("window.msIDBTransaction: " + window.msIDBTransaction);

			window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction || window.OIDBTransaction;

			trace("window.IDBKeyRange: " + window.IDBKeyRange);
			trace("window.webkitIDBKeyRange: " + window.webkitIDBKeyRange);
			trace("window.msIDBKeyRange: " + window.msIDBKeyRange);

			window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;
*/
			var span=$("#fichaAlfredo .label");
			if(window.indexedDB){
//				span.html("Yes");
//				span.attr('style','color:green');
				return true;
			}else{
				span.append('<p style="color:red;">Su navegador no puede almacenar regristros para las fichas.</p>');
				return false;
			}
		},
		deletedb=function(dbname){
//			trace("Delete " + dbname);
			var request=window.indexedDB.deleteDatabase(dbname);
			request.onsuccess=function(){
//				trace("Database "+dbname+" deleted!");
			};
			request.onerror=function(event){
				trace("deletedb(); error: "+event);
			};
		},
		open=function(dbname){
			var request=window.indexedDB.open(dbname,version);//3.1. Open a database async
			request.onupgradeneeded=function(event){//3.2 The database has changed its version (For IE 10 and Firefox)
//				trace("Upgrade needed!");
				db=event.target.result;
				modifydb(); //Here we can modify the database
			};
			request.onsuccess=function(event){
//				trace("Database opened");
				db=event.target.result;
/*				if (version != db.version && window.webkitIndexedDB) {//3.2 The database has changed its version (For Chrome)
//					trace("version is different");

					var setVersionreq = db.setVersion(version);

					setVersionreq.onsuccess = modifydb; //Here we can modify the database
				}*/
//				trace("Let's paint");
				if(pais_cli){
					items();//4. Read our previous objects in the store (If there are any)
				}
			};
			request.onerror=function(event){
				trace("Database error: "+event);
			};
		},
		modifydb=function(){
			var storeName='fichasMiami';
			//3.3 Create / Modify object stores in our database
			//2.Delete previous object store
			if (db.objectStoreNames.contains(storeName)){
				db.deleteObjectStore(storeName);
//				trace("db.deleteObjectStore('mywishes');");
			}
			//3.Create object store
			var store=db.createObjectStore(storeName,{keyPath:"id",autoIncrement:true});
			store.createIndex('by_user','usuario',{unique:false});
			store.createIndex('by_date','fecha',{unique:false});
		},
		add=function(){//4. Add objects
//			trace("add();");
			var trans=db.transaction(["fichasMiami"], "readwrite"),
				store=trans.objectStore("fichasMiami"),
				fecha=document.getElementById("108").value,
				usuario=user,//document.getElementById("91").value,
				pais=document.getElementById("82").value,
				text=document.querySelector('#fichaAlfredo #alfredo')
			var data={
				text:text.innerHTML,
				fecha:fecha,
				pais:pais,
				usuario:usuario
			};
			if(data.fecha&&data.pais&&data.usuario){
				var request=store.add(data);
				request.onsuccess=function(event){
	//				trace("wish added!");
					items(); //5 Read items after adding
				};
			}else{
				trace("Debe llenar todos los campos");
			}

		},
		items=function(){
			//5. Read
//			trace("items(); called");
			var list=$("#fichaMiami div:first"),
				trans=db.transaction(["fichasMiami"], "readonly"),
				store=trans.objectStore("fichasMiami");
			list.html("<hr />");
			var keyRange=IDBKeyRange.lowerBound(0);
			var cursorRequest=store.openCursor(keyRange);
			cursorRequest.onsuccess=function(event) {
//				trace("Cursor opened!");
				var result=event.target.result;
				if (result===false||result===null){
					return;
				}
				if(result.value.fecha==$('#filtros #fecha').val()&&result.value.usuario==user){
//					console.log($('#filtros #fecha').val()+' ---- '+result.value.fecha);
					render(result.value); //4.1 Create HTML elements for this object
				};
				result.continue ();
			};
		},
		render=function(item){
			//5.1 Create DOM elements
//			trace("Render items");
//				text+='<td>'+v+'</td>';
//console.log(item)
			var list=$("#fichaMiami div:first"),texto='',style='display:inline-block;padding:2px 15px 2px 2px;border:1px solid #000;margin:0 1px;';
//			texto+="<td>"+item.usuario+"</td>";
//			texto+="<td>"+item.fecha+"</td>";
//			texto+="<td>"+item.pais+"</td>";
			texto+="<div style='width:100%;text-align:justify;padding:10px;background:transparent;color:#000;'>"+item.text+"</div>";
			texto+="<div style='padding:0 0 10px 0;color:#000;background:transparent;'><span style='"+style+"'>"+pais_cli[item.pais].replace(/\,/ig,"</span><span style='"+style+"'>")+"</span><div>Pais: "+item.pais+" Fecha: "+item.fecha+"</div></div>";
			//6. Delete elements
/*			a.addEventListener("click", function() {
				del(item.timeStamp);
			});*/
			list.append(texto+'<hr />');
//			console.log(pais_cli)
		},
		del = function() {//falta revisar

			//6. Delete items
			var transaction = db.transaction(["fichasMiami"], "readwrite");
			var store = transaction.objectStore("fichasMiami");

			var request = store.delete(timeStamp);

			request.onsuccess = function(event) {
//				trace("Item deleted!");
				items(user); //5.1 Read items after deleting
			};

			request.onerror = function(event) {
				trace("Error deleting: " + e);
			};
		};

	//public members
	return {
		init:init,
		open:open,
		add:add,
		deletedb:deletedb,
		del:del
	};
};
/*window.onload = function() {

	var database = new fichasLibros();
	database.init("fichas",1); //database name and database version
	var btnAdd = document.getElementById("btnAdd");
	btnAdd.addEventListener("click", database.add);
//	var btnDel = document.getElementById("btnDel");
//	btnDel.addEventListener("click", database.deletedb);
};*/