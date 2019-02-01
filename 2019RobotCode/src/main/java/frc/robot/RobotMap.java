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
  // For example to map the left and right motors, you could define the
  // following variables to use with your drivetrain subsystem.
  // public static int leftMotor = 1;
  // public static int rightMotor = 2;

  // If you are using multiple modules, make sure to define both the port
  // number and the module. For example you with a rangefinder:
  // public static int rangefinderPort = 1;
  // public static int rangefinderModule = 1;
  public static final int LEFT_MOTOR_1 = 4, LEFT_MOTOR_2 = 1, RIGHT_MOTOR_1 = 2, RIGHT_MOTOR_2 = 3, LEFT_MOTOR_3 = 5, RIGHT_MOTOR_3 = 6;
  public static final int INTAKE_1 = 7, INTAKE_2 = 8;
  public static final int SOLENOID_1 = 3, SOLENOID_2 = 4, END_GAME_SOLENOID = 5;
  public static final int DRIVE_PIGEON = 3;
  public static final int ELBOW_MOTOR = 9;
  public static final int WRIST_MOTOR = 10;
  public static final int COMPRESSOR = 0;
  public static final int SHIFTER = 5;
}