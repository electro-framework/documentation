
/**
 * função para gerar tags com link para cada h2 da pagina
 */
function gerarContentChapter(){
  html = '<ul>';
  $('#pageContent').find('h2').each(function() {
    value = $(this).text();
    //checkar se tem um name, se não tiver atribuir-lhe um
    nameAttr = $(this).children('a');
    if ( nameAttr.length == 0 ) {
      $(this).prepend('<a name="'+value.toLowerCase()+'"></a>');
    }
    //gerar li
    html = html + gerarContentChapterLi(value);
  });
  html = html + '</ul>';
  $("#chapterContentsList").append(html);
}

function gerarContentChapterLi(value){
  html = '<li><a href="#'+ value.toLowerCase() +'">'+ value +'</a></li>'
  return html;
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

});
