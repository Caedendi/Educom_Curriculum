package nu.educom.bartcommandeur._5b2.objects;  /* JH: Dit worden domainObjects genoemd */

import java.time.LocalDate;

public class User {
    private int id;
    private String password;
    private boolean active;
    private boolean licenseToKill;
    private LocalDate licenseExpirationDate;

    public User(int id) {
        this.id = id;
    }

    /*
     * ========== ========== ==========
     * Getters & Setters
     * ========== ========== ==========
     */
    public int getId() {
        return id;
    }

    public String getPassword() {
        return password;
    }

    public boolean isActive() {
        return active;
    }

    public boolean isLicenseToKill() {
        return licenseToKill;
    }

    public LocalDate getLicenseExpirationDate() {
        return licenseExpirationDate;
    }
}
