/*----------------------------------------------------------------------------*/
/* Copyright (c) 2017-2018 FIRST. All Rights Reserved.                        */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot;

/**
 * The RobotMap is a mapping from the ports sensors and actuators are wired into
 * to a variable name. This provides flexibility changing wiring, makes checking
 * the wiring easier and significantly reduces the number of magic numbers
 * floating around.
 */
public class RobotMap {

  public static boolean USING_NEOS = false;
  public static boolean USING_ENCODERS = false;

  /*   
  public static int[] LEFT_MOTORS = new int[]{1,2,3};
  public static int[] RIGHT_MOTORS = new int[]{4,5,6};
  */

  public static int[] LEFT_MOTORS = new int[]{1,2};
  public static int[] RIGHT_MOTORS = new int[]{3,4};

  public static int NUM_DRIVE_MOTORS = 2; //per side

  public static int LEFT_DRIVE_ENCODER = 1;
  public static int RIGHT_DRIVE_ENCODER = 4;

  // For example to map the left and right motors, you could define the
  // following variables to use with your drivetrain subsystem.
  // public static int leftMotor = 1;
  // public static int rightMotor = 2;

  // If you are using multiple modules, make sure to define both the port
  // number and the module. For example you with a rangefinder:
  // public static int rangefinderPort = 1;
  // public static int rangefinderModule = 1;
}
