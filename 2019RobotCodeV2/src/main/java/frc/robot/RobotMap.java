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

  public static int[] LEFT_DRIVE_MOTORS = new int[]{3,4};
  public static int[] RIGHT_DRIVE_MOTORS = new int[]{1,2};

  public static int NUM_DRIVE_MOTORS = 2; //per side

  public static int LEFT_DRIVE_ENCODER = 1;
  public static int RIGHT_DRIVE_ENCODER = 4;

  public static int HATCH_EXTEND_SOLENOID_1 = 2, HATCH_EXTEND_SOLENOID_2 = 3;
  
  public static int HATCH_HOOK_SOLENOID_1 = 0, HATCH_HOOK_SOLENOID_2 = 1;

  public static int INTAKE_TOP_ROLLERS = 6, INTAKE_BOTTOM_ROLLERS = 5;

  public static int ARM = 15;

  public static int VISION_LIGHT = 0;

  public static int SHIFT_SOLENOID = 2;
  public static int LITTLE_ENDGAME_SOLENOID_1 = 3, LITTLE_ENDGAME_SOLENOID_2 = 5, BIG_ENDGAME_SOLENOID_1 = 4, BIG_ENDGAME_SOLENOID_2 = 6;
  
}
