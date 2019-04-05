/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;
import edu.wpi.first.wpilibj.DigitalOutput;
import edu.wpi.first.wpilibj.Relay;

public class DumbVision extends Command {
  public double kP, kI, kD, pTerm, iTerm, dTerm, prevError, errorSum;
  public double linearSpeed = 0;
  public DigitalOutput light;
  public DumbVision() {
    light = new DigitalOutput(4);
    kP = 0.0005;
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
    //System.out.println("dumbvisionstaaaaaaaawert");
    light.set(true);
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    double power1 = 0, power2 = 0;
    double error = Robot.m_jetson.getRawValues()[3];
    System.out.println(error);
    pTerm = kP*error;
    dTerm = kD*(error-prevError);
    iTerm = kI*(errorSum);
    errorSum += error;
    double correction = pTerm + dTerm + iTerm; 
    power1 = linearSpeed + correction;
    power2 = linearSpeed - correction;
    //System.out.println(error + " " + prevError + " " + errorSum);
    Robot.m_driveTrain.tankDrive(power1, power2);
    //stem.out.println(power1 + "  " + power2 + "  " + linearSpeed);
  }

  // Make this return true when this Command no longer needs to run execute()
  @Override
  protected boolean isFinished() {
    //return false;
    return Robot.m_oi.m_driver.getRawAxis(2) < 0.4;
  }

  // Called once after isFinished returns true
  @Override
  protected void end() {
    //System.out.println("dumbvisionendeeeeeeeeed");
    light.set(false);
  }

  // Called when another command which requires one or more of the same
  // subsystems is scheduled to run
  @Override
  protected void interrupted() {
  }
}
