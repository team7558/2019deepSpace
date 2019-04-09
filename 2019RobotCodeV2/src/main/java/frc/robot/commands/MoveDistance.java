/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;

public class MoveDistance extends Command {

  private double m_startPower, m_targetPower, m_endPower;
  private double m_accelerationPoint, m_deccelerationPoint;
  private double m_targetDistance, m_turnRatio;

  public MoveDistance(double startPower, double targetPower, double endPower, double accelerationPoint, double deccelerationPoint, double targetDistance, double turnRatio) {
    requires(Robot.m_drivetrain);
    m_startPower = startPower;
    m_targetPower = targetPower;
    m_endPower = endPower;
    m_accelerationPoint = accelerationPoint;
    m_deccelerationPoint = deccelerationPoint;
    m_targetDistance = targetDistance;
    m_turnRatio = turnRatio;
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
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
