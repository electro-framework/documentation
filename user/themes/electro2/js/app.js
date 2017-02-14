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

        ajaxRequestStaticSite().done(function( data ) {

            console.log(data);
        }).fail(function() {
            $("#generateMsg").html("Someting went wrong please try again!!!");
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
    //gerar content chapters no topo da pagina
    gerarContentChapter();

    //form para iniciar a geração de site estaico
    gerarSiteEstatico();

});
