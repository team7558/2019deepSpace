package frc.robot;

public class Util {
    public static double checkSpeed(double speed, double maxSpeed) {
        if (Math.abs(speed) < maxSpeed)
          return speed;
        return speed * Math.abs(maxSpeed / speed);
      }
}