package nu.educom.bartcommandeur._5b2.models;

import java.util.ArrayList;
import java.util.List;

public class MISixModel implements ILoginValidation {
    final int MIN_AGENT_ID = 1;
    final int MAX_AGENT_ID = 956;
    final int MIN_ID_DIGITS = Integer.toString(MIN_AGENT_ID).length();
    final int MAX_ID_DIGITS = Integer.toString(MAX_AGENT_ID).length();
    final String SECRET_PASSWORD = "For ThE Royal QUEEN";

    private MI6Error currentError;
    private List<String> blacklist;
    private String id;
    private String password;
    private boolean idValid = false;
    private boolean pwdValid = false;
    private boolean isLoggedIn = false;

    public MISixModel() {
        blacklist = new ArrayList<String>();
    }

    @Override
    public void processId() {
        if( id == null || id.isBlank() ) {
            // set error 1: empty input
            setError(MI6Error.ID_INPUT_EMPTY);
//            view.displayMessage("No ID provided.");
            return;
        }

        if( isNumericId() ) {
            checkLeftPaddingZeroes();
        }
        else {
            //set error 2: not a number
            setError(MI6Error.ID_INPUT_NOT_A_NUMBER);
//            view.displayMessage("This ID is invalid.");
            return;
        }
        if ( verifyId() ) {
            if( !isBlacklisted() ) {
                setIdValid(true);
                return;
            }
            else {
                // set error 4: blacklisted
                setError(MI6Error.ID_BLACKLISTED);
//                view.displayMessage("This agent has been blocked.");
                return;
            }
        }
        else {
            // set error 3: invalid ID
            setError(MI6Error.ID_INPUT_NOT_IN_VALID_RANGE);
//            view.displayMessage("This ID is invalid.");
            return;
        }
    }

    @Override
    public boolean isNumericId() {
        for (int i = 0; i < id.length(); i++) { // check if all characters in input string are numbers
            if (!Character.isDigit(id.charAt(i)))
                return false;
        }
        return true;
    }

    @Override
    public void checkLeftPaddingZeroes() {
        // add zeroes if smaller than specified digits
        if( id.length() < MAX_ID_DIGITS ) {
            for (int i = id.length(); i < MAX_ID_DIGITS; i++) {
                id = "0" + id; }
        }
        // else remove padded zeroes if larger than specified digits
        else if( id.length() > MAX_ID_DIGITS ) {
            for (int i = id.length(); i > MAX_ID_DIGITS; i--) {
                if( id.charAt(0) == '0' ) {
                    id = id.substring(1); } // removes a left padded 0
                else return;
            }
        }
    }

    @Override
    public boolean verifyId() {
        if( id.length() > MAX_ID_DIGITS ) {
            return false; }
        try {
            int idCopy = Integer.parseInt(id);
            return (idCopy >= MIN_AGENT_ID && idCopy <= MAX_AGENT_ID);
        }
        catch(NumberFormatException e) { // when the input ID string to parse is larger than int max value
            return false;
        }
    }

    @Override
    public void processPwd() {
        if( !getIdValid() ) {
            // set error 5: processing password while ID is not valid
            setError(MI6Error.PASSWORD_PROCESSING_WITH_INVALID_ID);
//            view.displayMessage("Error: asking for password while ID is not valid");
            return;
        }

        if( verifyPassword() ) {
            setPwdValid(true);
        }
        else {
            setIdValid(false);
            // set error 6: incorrect password
            setError(MI6Error.PASSWORD_INCORRECT);
//            view.displayMessage("Access denied. ID blocked from system.");
        }
    }

    @Override
    public boolean verifyPassword() {
        if( id.equals(null) || id.isBlank() || !idValid ) {
            setError(MI6Error.PASSWORD_PROCESSING_WITH_INVALID_ID);
            return false;
        }
        return ( password.equals(SECRET_PASSWORD) );
    }

    @Override
    public void blacklistAgent() {
        blacklist.add(id);
    }

    @Override
    public boolean isBlacklisted() {
        return blacklist.contains(id);
    }

    @Override
    public void loginAgent() {
        isLoggedIn = true;
    }

    @Override
    public void reset() {
        blacklist = new ArrayList<String>();
        id = null;
        password = null;
        idValid = false;
        pwdValid = false;
        isLoggedIn = false;
        currentError = null;
    }

    //=======================================//
    //========== Getters & Setters ==========//
    //=======================================//
    @Override
    public String getId() {
        return id;
    }

    @Override
    public void setId(String id) {
        this.id = id;
    }

    @Override
    public void setPassword(String password) {
        this.password = password;
    }

    @Override
    public boolean getIdValid() {
        return idValid;
    }

    @Override
    public void setIdValid(boolean idValid) {
        this.idValid = idValid;
    }

    @Override
    public boolean getPwdValid() {
        return pwdValid;
    }

    @Override
    public void setPwdValid(boolean pwdValid) {
        this.pwdValid = pwdValid;
    }

    @Override
    public boolean isLoggedIn() {
        return isLoggedIn;
    }

    @Override
    public MI6Error getError() {
        return currentError;
    }

    @Override
    public void setError(MI6Error error) {
        currentError = error;
    }

    @Override
    public void clearError() {
        currentError = null;
    }
}