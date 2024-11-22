
function changePage(newUrl){
	 // При клике на кнопку выполняется перенаправление на другую страницу
	 window.location.href = newUrl;
	 
}

function aboutProductRedirect(button_el){
	// При клике на кнопку выполняется перенаправление на другую страницу

	var productId = $(button_el).closest('.product-parent').data('id');

	newUrl="/online_store.php?content=product&pid="+productId;
	window.location.href = newUrl;
}

function showPopup(flag){
	let main_element	= $('.popup'),
	overlay_element = $('.overlay');
	
	if(flag){
		main_element.show();
		overlay_element.show();
	}
	else{
		main_element.hide();
		overlay_element.hide();
	}
	
}

function createBlockPages(products, recordsPerPage, page) {
	page=page-1;
    var start = page * recordsPerPage;
    var rowsPerPage = recordsPerPage;
	products=JSON.parse(products);
    var nrOfRows = products.length;
    var pages = Math.ceil(nrOfRows / rowsPerPage);

   // var pagProducts = products.slice(start, start + rowsPerPage);

    var productBox = document.createElement('section');
    productBox.className = 'product-box';
    productBox.innerHTML = '<h2>Каталог</h2><div class="row"></div>';
    var productContainer = productBox.querySelector('.row');

	
    for (var i = start; i < Math.min(start + rowsPerPage,nrOfRows); i++) {
		var product = products[i];
        var productElement = document.createElement('div');
        productElement.className = 'col-xs-6 col-sm-4 col-md-3 col-lg-3 product-parent';
        productElement.setAttribute('data-id', product.id);
        productElement.innerHTML = '<div class="product">' +
                                    '<div class="product-pic" style="background: url(\'' + product.image + '\') no-repeat; background-size: auto 100%; background-position: center"></div>' +
                                    '<span class="product-name">' + product.name + '</span>' +
                                    '<span class="product_price">' + product.price + ' руб.</span>' +
                                    '<button class="js_aboutProduct">Подробнее</button>' +
                                    '</div>';
        productContainer.appendChild(productElement);
    };

    var existingProductBox = document.querySelector('.product-box');
	existingProductBox.parentNode.replaceChild(productBox, existingProductBox);

	// Вывод информации о странице
	var pageInfo = document.createElement('div');
	pageInfo.className = 'page-info';
	pageInfo.textContent = 'Страница ' + (page + 1) + ' из ' + pages;


	// Создаем div элемент с классом "page-numbers"
	var pageNumbersDiv = document.createElement('div');
	pageNumbersDiv.className = 'page-numbers';
	pageUrl="online_store.php";
	// Цикл для добавления ссылок с номерами страниц
	for (var counter = 1; counter <= pages; counter++) {
    	var pageNumberLink = document.createElement('a');
    	pageNumberLink.href = pageUrl + '?page-nr=' + counter;
   		pageNumberLink.textContent = counter + ' ';
    	pageNumbersDiv.appendChild(pageNumberLink);
	}


	var existingpageInfo = document.querySelector('.page-info');
	existingpageInfo.parentNode.replaceChild(pageInfo, existingpageInfo);

	var existingpageNum= document.querySelector('.page-numbers');
	existingpageNum.parentNode.replaceChild(pageNumbersDiv, existingpageNum);
}


function refreshElementList() {
	// Получение текущего URL страницы
	const queryString = window.location.search;
	console.log(queryString);
	const urlParams = new URLSearchParams(queryString);

	// Получение значения параметра по его имени
	const paramValue = urlParams.get('page-nr');
	console.log(paramValue);
	// Если параметр страницы отсутсвует, установить значение по умолчанию равным 1
	const defaultValue = 1;
	const valueOrDefault = paramValue || defaultValue;

    $.ajax({
        url: 'ajaxAdmin.php', // Путь к файлу для получения списка элементов
        method: 'GET',
		data: {action: valueOrDefault},
        success: function(response){
			console.log(response);
			createBlockPages(response , 4,valueOrDefault);
        },
        error: function(xhr, status, error){
            console.error(xhr.responseText);
        }
    });
}


function addProduct() {

	let url = 'ajaxAdmin.php',
		data = {
			'name' : $('[name=gname]').val(),
			'price' : $('[name=gprice]').val(),
			'descr' : $('[name=gdesc]').val(),
		};

	$.ajax({
		url: url,
		type: "POST",
		data: data,
		dataType: 'json',
		success: function(response){
			console.log("add product eee")
			refreshElementList();
			$('#result').text(response); // Отображение результата изменения данных
		},
		error: function(xhr, status, error){
			console.log("wtf")
			console.error(xhr.responseText);
		}
	});

	showPopup(false);
}



function removeFromCart(button_el){

	var productId = $(button_el).closest('.product-parent').data('id');
	console.log('ID товара: ', productId);

	if (typeof jQuery != 'undefined') {
		// jQuery подключен
		console.log('jQuery подключен!');
	} else {
		// jQuery не подключен
		console.log('jQuery не подключен!');
	}

	$.ajax({
		url: 'removeCart.php', // Замените на путь к вашему PHP-обработчику
		method: 'POST',
		data: {action: productId}, // Данные, которые вы хотите передать на сервер
		success: function(response){
			window.location.href = "online_store.php?content=cart";
		},
		error: function(xhr, status, error){
			console.error(xhr.responseText);
		}
	});
}
function addToCart(button_el){
    // Получаем значение data-id кнопки, на которую кликнули
	//var productId = $(this).find('[name=product-id]').val(product_element.parents('.product-parent').data('id'));
	//var productId = $(this).closest('.product-parent').data('id');
	var productId = $(button_el).closest('.productAbout').data('id');
	console.log('ID товара: ', productId);

	if (typeof jQuery != 'undefined') {
		// jQuery подключен
		console.log('jQuery подключен!');
	} else {
		// jQuery не подключен
		console.log('jQuery не подключен!');
	}

	$.ajax({
		url: 'myajax.php', // Замените на путь к вашему PHP-обработчику
		method: 'POST',
		data: {action: productId}, // Данные, которые вы хотите передать на сервер
		success: function(response){
			console.log(response);
			if (response === "bad"){
				alert("В начале войдите в систему");
			}
			$('#result').text(response); // Отображение результата изменения данных
		},
		error: function(xhr, status, error){
			console.error(xhr.responseText);
		}
	});
}

$(document)
	.on('click', '.js_mainpage', function () { changePage('/online_store.php') })
	.on('click', '.js_aboutpage', function () { changePage('?content=about') })
	.on('click', '.js_login', function () { changePage('?content=login') })
	.on('click', '.js_cart', function () { changePage('?content=cart') })
	.on('click', '.js_logout', function () { changePage('?content=logout') })
	.on('click', '.js_addToCart', function () { addToCart(this) })
	.on('click', '.js_RemoveFromCart', function () { removeFromCart(this) })
	.on('click', '.js_aboutProduct', function () { aboutProductRedirect(this) })
	.on('click', '.js_close-popup', function () { showPopup(false) })
	.on('click', '.js_showPopup', function () { showPopup(true) })
	.on('click', '.js_send', function () { addProduct(); });