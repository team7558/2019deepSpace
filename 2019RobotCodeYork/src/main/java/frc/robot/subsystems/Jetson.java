/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;
import edu.wpi.first.networktables.*;

/**
 * Add your docs here.
 */
public class Jetson extends Subsystem {
  // Put methods for controlling this subsystem
  // here. Call these from Commands.

  private NetworkTable rawValues;

  public Jetson() {
    NetworkTableInstance inst = NetworkTableInstance.getDefault();
    rawValues = inst.getTable("rawValues");
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  public void printRawValues() {
    System.out.println("angle: " + rawValues.getEntry("angle").getDouble(-1));
  }

  public double[] getRawValues() {
    return new double[] { rawValues.getEntry("angle").getDouble(3.14 / 2), rawValues.getEntry("x").getDouble(0),
        rawValues.getEntry("y").getDouble(0), rawValues.getEntry("offset").getDouble(0) };
  }

}
