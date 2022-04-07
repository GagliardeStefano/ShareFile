package com.example.appweb;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class ContattiDAO {

    private final String URL = "jdbc:mysql://localhost:3306/webapp";
    private final String USER = "root";
    private final String PASS = "gagliarde";

    public void inserisci(String nome, String cognome, String nTelefonico) throws SQLException {

        Connection connection = DriverManager.getConnection(URL, USER, PASS);
        PreparedStatement statement = connection.prepareStatement("INSERT INTO contatti VALUE (?,?,?); ");

        statement.setString(1, nome);
        statement.setString(2, cognome);
        statement.setString(3, nTelefonico);

        statement.executeUpdate();

    }

    public void inserisciLink(String TuaEmail, String nTelefonico)throws SQLException{

        Connection connection = DriverManager.getConnection(URL, USER, PASS);
        PreparedStatement statement1 = connection.prepareStatement("INSERT INTO link VALUE (?,?);");
        statement1.setString(1, TuaEmail);
        statement1.setString(2,nTelefonico);

        statement1.executeUpdate();
    }

    public boolean existLink(String TuaEmail, String nTelefonico)throws SQLException{

        Connection connection = DriverManager.getConnection(URL, USER, PASS);
        PreparedStatement statement = connection.prepareStatement("SELECT * FROM link WHERE email = ? AND nTelefonico = ?");

        statement.setString(1,TuaEmail);
        statement.setString(2,nTelefonico);


        ResultSet resultSet = statement.executeQuery();

        if (resultSet.next()){
            return true;
        }else {
            return false;
        }
    }

    public boolean existNum(String nTelefonico)throws SQLException{
        Connection connection = DriverManager.getConnection(URL, USER, PASS);
        PreparedStatement statement = connection.prepareStatement("SELECT * FROM contatti WHERE nTelefonico = ?");

        statement.setString(1, nTelefonico);

        ResultSet resultSet = statement.executeQuery();

        if (resultSet.next()){
            return true;
        }else {
            return false;
        }
    }

    public List<Contatto> visualizza(String email) throws SQLException {

        Connection connection = DriverManager.getConnection(URL, USER, PASS);
        PreparedStatement statement = connection.prepareStatement("SELECT * FROM link JOIN contatti ON link.nTelefonico = contatti.nTelefonico WHERE email = ? ");

        statement.setString(1, email);
        statement.executeQuery();

        ResultSet resultSet = statement.getResultSet();

        List<Contatto> contattoList = new ArrayList<>();


        while (resultSet.next()){

            Contatto contatto = new Contatto( resultSet.getString(3),
                    resultSet.getString(4), resultSet.getString(5));

            contattoList.add(contatto);
        }

        return contattoList;
    }


    public void deleteContatto(String email, String nTelefonico) throws SQLException {

        Connection connection  = DriverManager.getConnection(URL, USER, PASS);
        PreparedStatement statement = connection.prepareStatement("DELETE FROM link WHERE email = ? AND nTelefonico = ?");

        statement.setString(1,email);
        statement.setString(2,nTelefonico);

        statement.executeUpdate();
    }

}
