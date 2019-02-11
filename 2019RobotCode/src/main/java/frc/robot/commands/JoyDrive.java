/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;

public class JoyDrive extends Command {
  private final double DRIVE_MAX = 0.75;
  private final double TURN_MAX = 0.75;
  public JoyDrive() {
    // Use requires() here to declare subsystem dependencies
    requires(Robot.m_driveTrain);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    // speed, turn, gyroEnabled
    Robot.m_driveTrain.drive(Robot.m_oi.m_driver.getRawAxis(Robot.m_oi.throttle)*DRIVE_MAX, Robot.m_oi.m_driver.getRawAxis(Robot.m_oi.whatDoWeCallIt)*TURN_MAX);
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
