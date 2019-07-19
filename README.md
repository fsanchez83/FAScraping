# FAScraping
Scraping en PHP de la web Filmaffinity para obtener las puntuaciones a partir del código del usuario

El proyecto consta de un archivo html, otro en php y la librería simple_html_dom.php

Para ejecutarlo, en el archivo html se debe incluir el código numérico que corresponde a un usuario de Filmaffinity.

Por ejemplo:
  Para el usuario: https://www.filmaffinity.com/es/userratings.php?user_id=270705, 
  habría que introducir como parámetro el código 270705.
  
Cuando termina el scraping (cuya duración depende del número de puntuaciones del usuario, se genera un archivo csv 
con todas las valoraciones a películas de ese usuario, con el siguiente formato:
  - Título, Director, Año, País, Puntuación, Fecha de votación
