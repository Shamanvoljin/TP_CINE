<?php namespace DAO;

   use DAO\Connection as Connection;

    interface IDAO
    {
        function addDAO($value);

        function getAllDAO();

        function deleteDAO($value);
    }
?>