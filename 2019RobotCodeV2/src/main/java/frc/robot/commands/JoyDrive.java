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
  public JoyDrive() {
    requires(Robot.m_drivetrain);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    if (Robot.m_oi.m_driver.getRawAxis(Robot.m_oi.RT) > 0.4){
      Robot.m_drivetrain.setMaxSpeeds(0.4, 0.5);
    } else {
      Robot.m_drivetrain.setMaxSpeeds(0.8, 0.7);
    }
    Robot.m_drivetrain.arcadeDrive(-Robot.m_oi.m_driver.getRawAxis(Robot.m_oi.LJY), Robot.m_oi.m_driver.getRawAxis(Robot.m_oi.RJX));
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
