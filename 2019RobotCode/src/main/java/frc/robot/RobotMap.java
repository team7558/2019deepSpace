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
  public static final int LEFT_MOTOR_1 = 1, LEFT_MOTOR_2 = 2, RIGHT_MOTOR_1 = 4, RIGHT_MOTOR_2 = 5, LEFT_MOTOR_3 = 3, RIGHT_MOTOR_3 = 6;
  public static final int INTAKE_1 = 9, INTAKE_2 = 10, HATCH_SUCTION = 12, ELBOW_MOTOR = 7, WRIST_MOTOR = 8;
  public static final int SHOOT_HATCH = 0, SHOOT_SOLENOID = 1, SHIFT_SOLENOID = 2, LITTLE_ENDGAME_SOLENOID_1 = 3, LITTLE_ENDGAME_SOLENOID_2 = 5, BIG_ENDGAME_SOLENOID_1 = 4, BIG_ENDGAME_SOLENOID_2 = 6;
  public static final int DRIVE_PIGEON = 11;
  public static final int COMPRESSOR = 0;
  public static final int BACK_WRIST_SWITCH = 0, FRONT_WRIST_SWITCH = 3, BACK_ELBOW_SWITCH = 1, FRONT_ELBOW_SWITCH = 2;
  public static final int FRONT_LIGHT_RELAY = 0;
}