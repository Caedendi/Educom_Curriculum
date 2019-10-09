package nu.educom.bartcommandeur._5b1;

import java.util.ArrayList;
import java.util.Scanner;

public class MISIX1 {
    static final int MIN_AGENT_ID = 1;
    static final int MAX_AGENT_ID = 956;
    static final int ID_DIGITS = Integer.toString(MAX_AGENT_ID).length();
    static final String SECRET_PASSWORD = "For ThE Royal QUEEN";

    static Scanner scanner = new Scanner(System.in);
    static ArrayList<String> blacklist = new ArrayList<String>();

    public static void main(String[] args) {
        System.out.println("MI SIX STARTED");
        String inputId;
        String inputPassword;

        while(true) {
            inputId = askForId();
            if( isNumber(inputId) && isCorrectId(Integer.parseInt(inputId)) ) {
                inputId = addPaddingZeroes(inputId);
                if( !isBlacklisted(inputId) ) {
                    inputId = approveId(inputId);
                }
                else {
                    continue;
                }
            }
            else {
                System.out.println("Incorrect ID.");
                continue;
            }

            inputPassword = askForPassword();
            if( isCorrectPassword(inputId, inputPassword) ) {
                System.out.println("Password approved.");
                loginAgent(inputId);
                break;
            }
            else {
                System.out.println("Incorrect password.");
                blacklistAgent(inputId);
            }
        }
        System.out.println("Press enter to exit program.");
        scanner.nextLine();
    }



    public static String askForId() {
        System.out.println();
        System.out.println("Please insert your ID.");
        String input = scanner.nextLine();
        System.out.println();
        return input;
    }

    public static boolean isNumber(String input) {
        if( input == null || input.isEmpty() ) { // check if empty
            return false;
        }
        if( input.length() > (ID_DIGITS + 1) ) { // check if string larger than 3 digits
            return false;
        }
        for( int i = 0; i < input.length(); i++ ) { // check if all input string characters are ints
            char c = input.charAt(i);
            if( c < '0' || c > '9' ) {
                return false;
            }
        }
        return true;
    }

    public static boolean isCorrectId(int input) {
        return ( input >= MIN_AGENT_ID && input <= MAX_AGENT_ID );
    }

    public static boolean isBlacklisted(String input) {
        if( blacklist.contains(input) ) {
            System.out.println("ID " + input + " has been blacklisted.");
            return true;
        }
        else return false;
    }

    public static String approveId(String input) {
        System.out.println("ID approved.");
        System.out.println("Your ID is " + input);
        return input;
    }

    public static String addPaddingZeroes(String input) {
        String padded = input;
        for( int i = input.length(); i < ID_DIGITS; i++ ) {
            padded = "0" + padded;
        }
        return padded;
    }

    public static String askForPassword() {
        System.out.println();
        System.out.println("Please enter your password");
        String input = scanner.nextLine();
        System.out.println();
        return input;
    }

    public static boolean isCorrectPassword(String id, String password ) {
        return ( password.equals(SECRET_PASSWORD) );
    }

    public static void blacklistAgent(String agentId) {
        blacklist.add(agentId);
        System.out.println("ID " + agentId + " has been blacklisted.");
    }

    public static void loginAgent(String inputId) {
        System.out.println();
        System.out.println("Agent " + inputId + ", you have been successfully logged in.");
    }
}
