/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import edu.wpi.first.wpilibj.*;
import frc.robot.Robot;

public class PVisionTime extends Command {

  private double m_kP, m_power;

  public PVisionTime(double time) {
    // Use requires() here to declare subsystem dependencies
    // eg. requires(chassis);
    setTimeout(time);
    m_kP = 0.001;
    m_power = -0.4;
    requires(Robot.m_drivetrain);
    requires(Robot.m_jetson);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
    Robot.m_visionLight.set(Relay.Value.kOn);
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    double error = Robot.m_jetson.getRawValues()[3];
    double kTerm = m_kP*error;
    Robot.m_drivetrain.tankDrive(m_power+kTerm, m_power-kTerm);
  }

  // Make this return true when this Command no longer needs to run execute()
  @Override
  protected boolean isFinished() {
    return isTimedOut();
  }

  // Called once after isFinished returns true
  @Override
  protected void end() {
    Robot.m_visionLight.set(Relay.Value.kOff);
  }

  // Called when another command which requires one or more of the same
  // subsystems is scheduled to run
  @Override
  protected void interrupted() {
  }
}
