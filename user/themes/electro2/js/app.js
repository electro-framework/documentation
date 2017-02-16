
/**
 * função para gerar tags com link para cada h2 da pagina
 */
function gerarContentChapter(){
  //
  html = '<ul>';
  $('#pageContent').find('h2').each(function() {
    //texto do h2
    value = $(this).text();
    //checkar se tem um name, se não tiver atribuir-lhe um
    gerarNameAttr( $(this) );
    //gerar li
    html = html + gerarContentChapterLi( value.toLowerCase() );
    //verificar se tem topicos h3
    if ($(this).nextUntil("h2", "h3").length) {
      //abrir ul
      html = html + "<ul>";
      //loop
      $.each($(this).nextUntil("h2", "h3"), function(index, subEl) {
        //
        text = $(subEl).map(function(index, elem) { return elem; });
        //
        html = html + gerarContentChapterLi( text.text().toLowerCase() ) + "</li>";
        //checkar se tem um name, se não tiver atribuir-lhe um
        gerarNameAttr( text );
        //gerar pemalink para partilhar junto ao topico
        $(this).prepend( gerarPermaLink( text ) );
      });
      //fechar ul
      html = html + "</li></ul>";
    } else {
      html = html + "</li>";
    }
  });
  //fechar ul principal
  html = html + '</ul>';
  //append
  $("#chapterContentsList").append(html);
}

function gerarNameAttr ( block ) {
  nameAttr = $(block).children('a');
  if ( nameAttr.length == 0 ) {
    $(block).prepend('<a name="'+block[0].textContent.toLowerCase()+'"></a>');
  }
}

function gerarContentChapterLi( value ){
  html = '<li><a href="#'+ value +'">'+ value +'</a>'
  return html;
}

function gerarPermaLink( value ){
    var pathname = window.location.pathname;
    link = '<button class="btn btn-default permaLinkShare" data-clipboard-text="'+ pathname + '/#' + value +'">' +
        '<i class="fa fa-clipboard" aria-hidden="true"></i>' +
        '</button>';
    return link;
}

/**
 * função para gerar site estatico
 */
function gerarSiteEstatico(){

    $("#initStaticSite").submit( function( event ) {

        //mostrar div de loading
        $("#loadingArea").fadeIn();
        $("#generateMsg").html('');
        ajaxRequestStaticSite().done(function( data ) {

            if ( data == "1" ) {
                $("#generateMsg").html("Static web page Created Successfully").addClass('alert-success');
                $("#loadingArea").fadeOut();
            }

            if ( data == "0" ){
                $("#generateMsg").html("Error in the creation of static web page!!!").addClass('alert-danger');
                $("#loadingArea").fadeOut();
            }


        }).fail(function() {
            $("#generateMsg").html("Someting went wrong please try again!!!").addClass('alert-danger');
            $("#loadingArea").fadeOut();
        });

        event.preventDefault();
    });
}

/**
 * ajax requests
 */
function ajaxRequestStaticSite () {
    var url = 'generate-static/init';
    return $.ajax({
        method: 'GET',
        url: url
    });
}

$(document).ready(function() {

    //hide loading e msg output
    $("#loadingArea").hide();
    //gerar content chapters no topo da pagina
    gerarContentChapter();

    //form para iniciar a geração de site estaico
    gerarSiteEstatico();

    //permalink share ao clickar
    var clip = new Clipboard('.permaLinkShare');

});
