/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;

public class DumbVision extends Command {
  public DumbVision() {
    requires(Robot.m_driveTrain);
    requires(Robot.m_jetson);
    // Use requires() here to declare subsystem dependencies
    // eg. requires(chassis);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    System.out.println("salad");
    double offset = Robot.m_jetson.getRawValues()[3];
    double linearSpeed = 0.4;
    double power1 = linearSpeed;
    double power2 = linearSpeed;
    double k = 0.025;
    power1 -= offset*k;
    power2 += offset*k;
    System.out.println(offset);
    Robot.m_driveTrain.tankDrive(power1, power2);
  }

  // Make this return true when this Command no longer needs to run execute()
  @Override
  protected boolean isFinished() {
    return false;
  }

  // Called once after isFinished returns true
  @Override
  protected void end() {
  }

  // Called when another command which requires one or more of the same
  // subsystems is scheduled to run
  @Override
  protected void interrupted() {
  }
}
