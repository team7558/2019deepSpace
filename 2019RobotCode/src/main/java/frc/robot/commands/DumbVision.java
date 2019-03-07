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
  public double kP, kI, kD, pTerm, iTerm, dTerm, prevError, errorSum; 
  public DumbVision() {
    kP = 0.0015;
    kD = 0;
    kI = 0;
    prevError = 0;
    errorSum = 0;

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
    double power1 = 0, power2 = 0;
    double error = Robot.m_jetson.getRawValues()[3];
    //double linearSpeed = 0.3;
    double linearSpeed = -Robot.m_oi.m_driver.getRawAxis(1);
    //double joyTurn = Robot.m_oi.m_driver.getRawAxis(4);
    pTerm = kP*error;
    dTerm = kD*(error-prevError);
    iTerm = kI*(errorSum);
    errorSum += error;
    double correction = pTerm + dTerm + iTerm; 
    power1 = linearSpeed - correction;
    power2 = linearSpeed + correction;
    //System.out.println(error + " " + prevError + " " + errorSum);
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
