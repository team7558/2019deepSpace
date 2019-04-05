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

  protected double turnRatio, targetDistance, power;

  public MoveDistance(double targetDistance, double power, double turnRatio) {
    this.turnRatio = turnRatio;
    this.targetDistance = targetDistance;
    this.power = power;
    requires(Robot.m_driveTrain);
    // Use requires() here to declare subsystem dependencies
    // eg. requires(chassis);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
    Robot.m_driveTrain.resetDistance();
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    System.out.println(Robot.m_driveTrain.distanceTraveled()[0] + " " + power);
    //Robot.m_driveTrain.tankDrive(power, power*turnRatio);
  }

  // Make this return true when this Command no longer needs to run execute()
  @Override
  protected boolean isFinished() {
    return Math.abs(Robot.m_driveTrain.distanceTraveled()[0]) >= targetDistance;
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
