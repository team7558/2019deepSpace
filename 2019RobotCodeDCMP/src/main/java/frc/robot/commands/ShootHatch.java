/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;

public class ShootHatch extends Command {
  
  public ShootHatch() {
    super();
    // Use requires() here to declare subsystem dependencies
    requires(Robot.m_arm);
    requires(Robot.m_claw);
    //setTimeout(0.5);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
    Robot.m_claw.extendHatch();
    System.out.println("Extend Hatch");
    Robot.m_claw.shootHatch();
    System.out.println("Shoot Hatch");
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    //Robot.m_arm.changePreset("SHOOT_HATCH");
  }

  // Make this return true when this Command no longer needs to run execute()
  @Override
  protected boolean isFinished() {
    //return isTimedOut();
    //System.out.println(!Robot.m_oi.m_driver.getRawButton(Robot.m_oi.shootHatchButton));
    return !Robot.m_oi.m_operator.getRawButton(Robot.m_oi.shootHatchButton);
  }

  // Called once after isFinished returns true
  @Override
  protected void end() {
    Robot.m_claw.intakeHatch();
    System.out.println("IntakeHatch");
  }

  // Called when another command which requires one or more of the same
  // subsystems is scheduled to run
  @Override
  protected void interrupted() {
    
    }
}
